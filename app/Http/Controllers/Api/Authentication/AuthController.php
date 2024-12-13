<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginFormRequest $request)
    {
        return response()->json($this->service->login($request));
    }

    public function register(RegisterFormRequest $request)
    {
        return response()->json($this->service->register($request));
    }

    public function logout()
    {
        return response()->json($this->service->logout());
    }

    public function forgotPassword(ForgotPasswordFormRequest $request)
    {
        return response()->json($this->service->forgotPassword($request));
    }

    public function verifyPasswordResetToken(Request $request)
    {
        return response()->json($this->service->verifyPasswordResetPassword($request));
    }

    public function resetPassword(ResetPasswordFormRequest $request)
    {
        return response()->json($this->service->resetPassword($request));
    }

    public function changePassword(ChangePasswordFormRequest $request)
    {
        return $this->service->changePassword($request);
    }

    public function sendVerificationEmail(Request $request)
    {
        return response()->json($this->service->sendVerificationEmail($request));
    }

    public function verifyEmail(Request $request)
    {
        return response()->json($this->service->verifyEmail($request));
    }

    public function getAuthenticatedUser(Request $request)
    {
        return response()->json($this->service->getAuthenticatedUser($request));
    }
    public function registerCompany(Request $request)
    {
        return response()->json($this->service->registerCompany($request));
    }
}
