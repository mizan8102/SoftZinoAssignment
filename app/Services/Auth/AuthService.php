<?php

namespace App\Services\Auth;

use App\Enums\ApiResponseEnum;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\Contracts\Auth\AuthRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthRepositoryInterface
{
    /**
     * Attempt to log in a user with the provided credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            return [
                'message' => 'Email or password is incorrect',
                'status' => ApiResponseEnum::ERROR,
            ];
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return [
            'user' => new UserResource($user),
            'token' => $token,
            'status' => ApiResponseEnum::SUCCESS,
        ];
    }

    /**
     * Log out the currently authenticated user by revoking all tokens.
     *
     * @return bool
     */
    public function logout(): bool
    {
        if (Auth::user()) {
            Auth::user()->tokens()->delete();
            return true;
        }
        return true;
    }

    /**
     * Register a new user with the provided request data.
     *
     * @param mixed $request
     * @return User|string
     */
    public function register($request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return $user;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
