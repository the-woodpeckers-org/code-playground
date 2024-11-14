<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    private UserService $service;
    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function getUsers() {

    }

    public function uploadAvatar(Request $request) {
        return response()->json($this->service->uploadAvatar($request));
    }
}
