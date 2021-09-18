<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Suppport\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $body = $request->validated();

        $user = User::create([
            'name' => $body['name'],
            'username' => $body['username'],
            'email' => $body['email'],
            'password' => bcrypt($body['password'])
        ]);

        $token = $user->createToken('access_token')->plainTextToken;

        $response = [
            'data' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}
