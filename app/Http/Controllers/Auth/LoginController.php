<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        try {


            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => false,
                    'message' => "Email or password is incorrect",
                ], 500);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'Welcome',
                'token' => $user->createToken("ok")->plainTextToken,
            ], 201);

//        $user->assignRole('customer');


//        RegisteredEvent::dispatch($user);


        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        Auth::guard('web')->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
