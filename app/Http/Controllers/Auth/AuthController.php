<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $body = $request->validated();

        // check username
        $user = User::where('username', $body['username'])->first();

        // check password
        if (!$user || !Hash::check($body['password'], $user->password)) {
            return response([
                'message' => 'Bad Credentials'
            ], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        $response = [
            'data' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}
