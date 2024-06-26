<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => false,
                    'message' => "Email or password is incorrect",
                ], 401); // 401 is more appropriate for unauthorized access
            }
            $user = Auth::user();
            $tokenResult = $user->createToken(' Personal Access Token');

            $token = $tokenResult->accessToken;


            Session::put('access_token', $token);

            return response()->json([
                'status' => true,
                'message' => 'Welcome',
               'token' => $token,
            ], 200);

        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->token()->revoke();

        // Remove the token from the session
        Session::forget('Personal Access Token');

        return response()->json([
            "message" => "User logged out successfully"
        ], 200);
    }
}
