<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        ],
        [
            'title.min' => 'The access code must be at least 2 characters.',
            'title.max' => 'The access code may not be greater than 16 characters.',
            'title.required' => 'The access code field is required.',
            'title.unique' => 'The access code has already been taken.',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            // Success

            // Add logged in user's name and email to request
            $request->request->add(['name' => auth()->user()->name]);
            $request->request->add(['email' => auth()->user()->email]);

            // Create Access Code
            $new_access_token_title = TokenController::store($request);

            return back()->with('success', "Access code, $new_access_token_title, has been created!");
        }
    }
}
