<?php

namespace App\Services\User;

use App\Repositories\Eloquent\User\UserRepositoryInterface;

class UserService implements UserRepositoryInterface
{
    public function getCurrentUser()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return $user;
        } else {
            return null;
        }
    }

}