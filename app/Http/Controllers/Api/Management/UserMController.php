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
    public function getListSubscribe()
    {
        return $this->service->getListSubscribe();
    }
    public function approvedSubscribeCompany($id)
    {
        return $this->service->approvedSubscribeCompany($id);
    }
    public function rejectSubscribeCompany($id)
    {
        return $this->service->rejectSubscribeCompany($id);
    }
}
