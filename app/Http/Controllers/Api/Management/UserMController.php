<?php

namespace App\Http\Controllers\api\Management;

use App\Services\Management\UserMService;
use GuzzleHttp\Psr7\Request;

class UserMController
{
    private UserMService $service;

    public function __construct(UserMService $userMService)
    {
        $this->service = $userMService;
    }
    public function getAllUser()
    {
       return $this->service->getAllUser();
    }
    public function deleteUser($id)
    {
        return $this->service->deleteUser($id);
    }
    public function updateUser()
    {
        
    }
    public function getUser()
    {
        
    }
    public function getListSubscribe()
    {
        return $this->service->getListSubscribe();
    }
    public function approvedSubscribe($id)
    {
        return $this->service->approvedSubscribe($id);
    }
    public function rejectSubscribe($id)
    {
        return $this->service->rejectSubscribe($id);
    }
}
