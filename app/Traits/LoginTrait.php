<?php

namespace App\Traits;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

trait LoginTrait {

    /**
     * to create new user
     * @param Request $request
     * @return string <json>
     */
    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return Response::json([
                'error' => 1,
                'data' => [
                    'errors' => $validator->errors()
                ]
            ]);
        }

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'status' => 'activated',
            'permission_id' => 2,
            'password' => bcrypt($request['password']),
        ]);

        return Response::json([
            'error' => 0,
            'data' => [
                'user' => json_decode($user)
            ]
        ], 200);
    }

    /**
     * to create token after check that credentials right
     * @param Request $request
     * @return string <json>
     */
    public function userLogin(Request $request)
    {
        $credentials = '';
        $returnArray = [];
        if (isset($request->email)) {
            $credentials = $request->only('email', 'password');
        }

        if (! $token = JWTAuth::attempt($credentials)) {
            $returnArray['error'] = 1;
            $returnArray['data'] = "invalid login";
        } else {
            $returnArray['error'] = 0;
            $returnArray['data'] = $token;
        }
        return Response::json($returnArray, 200);
    }
}