<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [

                'email' => 'required', 'email',
                'password' => 'required',
            ]);
            if ($validateUser->fails()) {
                return response()->json($validateUser->errors(), 400);
            }

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
       \auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully',
            'data' => [],
            'id' => \auth()->user()->id
        ], 200);
    }
}
