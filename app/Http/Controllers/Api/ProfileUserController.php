<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProfileUserService;

class ProfileUserController
{
    //

    private ProfileUserService $service;
    public function __construct(ProfileUserService $_service)
    {
        $this->service = $_service;
    }
    public function getProfileCV(Request $request) {
        return $this->service->getProfileCV($request);
    }
}
