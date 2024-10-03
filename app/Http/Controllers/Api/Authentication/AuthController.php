<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    private AuthService $service;

    public function __construct(AuthService $service) {
        $this->service = $service;
    }
    public function login(LoginFormRequest $request)
    {
        return $this->service->login($request);
    }

    public function register(RegisterFormRequest $request)
    {
        return $this->service->register($request);
    }

    public function logout(Request $request)
    {
        return $this->service->logout();
    }

    public function getAuthenticatedUser() {
        return $this->service->getAuthenticatedUser();
    }
}
