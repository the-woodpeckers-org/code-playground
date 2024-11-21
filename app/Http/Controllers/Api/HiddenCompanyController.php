<?php

namespace App\Http\Controllers\api;

use App\Services\HiddenCompanyService;
use Illuminate\Http\Request;

class HiddenCompanyController
{
    //
    private HiddenCompanyService $service;
    public function __construct(HiddenCompanyService $service)
    {
        $this->service = $service;
    }
    
    public function addHiddenCompany(Request $request)
    {
        return $this->service->addHiddenCompany($request);
    }

    public function removeHiddenCompany(Request $request)
    {
        return $this->service->removeHiddenCompany($request);
    }
}
