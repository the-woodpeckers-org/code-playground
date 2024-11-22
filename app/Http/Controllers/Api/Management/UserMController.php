<?php

namespace App\Http\Controllers\api\Management;

use App\Services\Management\UserMService;

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
    public function deleteUser()
    {
        
    }
    public function updateUser()
    {
        
    }
    public function getUser()
    {
        
    }
    public function addUser()
    {

    }

}
