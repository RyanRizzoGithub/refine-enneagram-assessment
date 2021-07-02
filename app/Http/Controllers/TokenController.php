<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TokenController extends Controller
{
    static public function store($request)
    {
        $token = new Token();

        if ($request->title) {
            $token->title = $request->title;
        } else {
            $random_token = Str::random(16);

            while (!is_null(Token::where('title', $random_token)->first())) {
                $random_token = Str::random(16);
            }

            $token->title = $random_token;
        }

        $token->uses = $request->uses ? $request->uses : 1;
        $token->email = $request->email;
        $token->save();

        return $token->title;
    }

    public function search($token_title)
    {
        $token = Token::where('title', $token_title)->first();

        if (is_null($token)) {
            $response = array('success' => false, 'message' => 'Token does not exist.');
        } else {
            $response = array('success' => true, 'access_token' => $token);
        }

        return response()->json($response, 200);
    }

    public function redeem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'bail|required|string|min:2',
            'last_name'  => 'bail|required|string|min:2',
            'email' => 'bail|required|email',
            // TODO: This is the access code. Why does this have to be called "title"?
            'title' => [
                'bail',
                'required',
                'string',
                'exists:tokens',
                Rule::exists('tokens')->where(function ($query) {
                    $query->where('uses', '>', 0);
                }),
            ],
        ],
        [
            'title.exists' => 'Sorry, either that is not a valid access code or it is all used up.',
        ]);

        if ($validator->fails()) {
            $validator->validate();
        } else {
            $response = array('success' => true, 'access_token' => $request->title);
        }

        return response()->json($response, 200);
    }
}
