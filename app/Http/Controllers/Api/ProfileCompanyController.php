<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\ProfileCompanyService;
use App\Models\ProfileCompany;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileCompanyController
{
    private ProfileCompanyService $_service;
    //
    public function __construct(ProfileCompanyService $service)
    {
        $this->_service = $service;
    }

    public function getProfileCompany($id)
    {
        return $this->_service->getProfileCompany($id);
    }
    public function getProfileCompanyByUserId(Request $request)
    {
        return $this->_service->getProfileCompanyByUserId($request);
    }
    public function updateProfileCompany(Request $request)
    {
        return $this->_service->updateProfileCompany($request);
    }
    public function createProfileCompany(Request $request)
    {
        
    }

    public function deleteProfileCompany(Request $request)
    {
        
    }
    
}
