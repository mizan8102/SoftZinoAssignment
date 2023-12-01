<?php

namespace App\Http\Controllers\User;

use App\Enums\HttpStatusCodeEnum;
use App\Http\ApiResponse\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{


    private $userRepositoryInterface;

    use ApiResponseTrait;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    public function getCurrentUser(){
        $res = $this->userRepositoryInterface->getCurrentUser();
        if ($res) {
            return $this->successResponse($res, "Data retrive");
        } else {
            return $this->errorResponse("retrive failed", HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
}
