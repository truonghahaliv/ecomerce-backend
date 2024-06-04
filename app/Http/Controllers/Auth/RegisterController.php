<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
            ]);
            if ($validateUser->fails()) {
                return response()->json($validateUser->errors(), 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);


//        $user->assignRole('customer');


//        RegisteredEvent::dispatch($user);


            return response()->json([
                'status' => true,
                'message' => 'User register successfully',
                'token' => $user->createToken("ok")->plainTextToken,
            ], 201);
        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
