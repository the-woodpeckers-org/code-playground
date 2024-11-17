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
    public function updateProfileCV(Request $request) {
        return $this->service->updateProfileCV($request);
    }
    public function setActiveProfile(Request $request) {
        return $this->service->setActiveProfile($request);
    }

    public function getUserCVToView($id)
    {
        return $this->service->getUserCVToView($id);
    }
}
