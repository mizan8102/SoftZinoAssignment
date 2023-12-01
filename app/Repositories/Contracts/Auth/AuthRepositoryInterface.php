<?php

namespace App\Repositories\Contracts\Auth;

use App\Http\Resources\User\UserResource;

interface AuthRepositoryInterface
{
    /**
     * Attempt to log in a user using provided credentials.
     *
     * @param array $credentials User login credentials (e.g., ['email' => 'user@example.com', 'password' => 'password']).
     *@return array
     */
    public function login(array $credentials):array;

    /**
     * Log out the currently authenticated user.
     *
     * @return bool
     */
    public function logout(): bool;

    /**
     * Register a new user with the given data.
     *
     * @param array $data User registration data (e.g., ['name' => 'John Doe', 'email' => 'user@example.com', 'password' => 'password']).
     *
     * @return bool True if registration is successful, false otherwise.
     */
    public function register($data);
}