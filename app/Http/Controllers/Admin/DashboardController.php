<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TokenController;
use App\Token;

class DashboardController extends Controller
{
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Create access code from admin dashboard.
     */
    public function create_access_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|bail|required|string|min:2|max:16|unique:tokens',
            'uses'  => 'sometimes|bail|required|integer|min:1|max:1000',
            'email' => 'nullable|email',
        ],
        [
            'title.min' => 'The access code must be at least 2 characters.',
            'title.max' => 'The access code may not be greater than 16 characters.',
            'title.required' => 'The access code field is required.',
            'title.unique' => 'The access code has already been taken.',
            'email.email' => 'The owner email must be a valid email address.',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            // Success

            // The "owner" is who should receive the results email for this code.
            // Admins can set it (e.g. buying a code for someone else); it defaults
            // to the logged-in admin when left blank.
            $owner_email = $request->filled('email') ? $request->input('email') : auth()->user()->email;

            $request->request->add(['name' => auth()->user()->name]);
            $request->request->set('email', $owner_email);

            // Create Access Code
            $new_access_token_title = TokenController::store($request);

            return back()->with('success', "Access code, $new_access_token_title, has been created for $owner_email!");
        }
    }

    /**
     * Let a logged-in admin change their own password.
     */
    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|confirmed',
        ],
        [
            'new_password.min'       => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'password');
        }

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.'], 'password');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', 'Your password has been updated.');
    }
}
