<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\RegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    //
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {

            $user = $this->userRepository->store($request->all());
            $user->assignRole('viewer');
            RegisteredEvent::dispatch($user);
            return response()->json([
                'status' => true,
                'message' => 'User register successfully',
            ], 201);
        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
