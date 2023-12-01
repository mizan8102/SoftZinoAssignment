<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ApiResponseEnum;
use App\Enums\HttpStatusCodeEnum;
use App\Http\ApiResponse\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\Auth\AuthRepositoryInterface;

class AuthController extends Controller
{


    private $authRepository;

    use ApiResponseTrait;
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $authRequest)
    {
        $data = $authRequest->validated();
        $res = $this->authRepository->login($data);
        if ($res["status"] == ApiResponseEnum::SUCCESS) {
            return $this->successResponse($res, "login successfull");
        } else {
            return $this->errorResponse($res, HttpStatusCodeEnum::BAD_REQUEST);
        }

    }

    public function register(RegisterRequest $registerRequest)
    {

        $data = $registerRequest->validated();
        $res = $this->authRepository->register($data);
        if ($res) {
            return $this->successResponse($res, "registration successfull");
        } else {
            return $this->errorResponse("registration failed", HttpStatusCodeEnum::BAD_REQUEST);
        }

    }

    public function logout()
    {

        $res = $this->authRepository->logout();
        if ($res) {
            return $this->successResponse($res, "logout successfull");
        } else {
            return $this->errorResponse("logout failed", HttpStatusCodeEnum::BAD_REQUEST);
        }

    }

}
