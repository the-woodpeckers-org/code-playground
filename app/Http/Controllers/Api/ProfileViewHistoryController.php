<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\ProfileViewHistoryService;
class ProfileViewHistoryController
{
    //
    private ProfileViewHistoryService $service;

    public function __construct(ProfileViewHistoryService $service)
    {
        $this->service = $service;
    }
    public function addViewHistory(Request $request)
    {
        return $this->service->addViewHistory($request);
    }
    public function getListCompanyView(Request $request)
    {
        return $this->service->getListCompanyView($request);
    } 

}
