<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        $userData = \auth()->user();
        return response()->json([
            'status' => true,
            'message' => 'Profile Information',
            'data' => $userData,
            'id' => \auth()->user()
        ], 201);
    }
}
