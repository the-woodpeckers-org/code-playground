<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service) {
        $this->service = $service;
    }
    public function login(LoginFormRequest $request)
    {
        return $this->service->login($request);
    }

    public function register(Request $request)
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
