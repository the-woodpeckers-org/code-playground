<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\ApplicationService;
class ApplicationController
{
    //
    private ApplicationService $service;

    public function __construct(ApplicationService $_service)
    {
        $this->service = $_service;
    }

    public function getJobsApplied(Request $request)
    {
        return $this->service->getJobsApplied($request);
    }

    public function applyCV(Request $request)
    {
        return $this->service->applyCV($request);
    }
   
    public function getCV_Applied(Request $request)
    {
        return $this->service->getCV_Applied($request);
    }
    public function isApplied($id,Request $request)
    {
        return $this->service->isApplied($id,$request);
    }
    public function cancelApply($id,Request $request)
    {
        return $this->service->cancelApply($id,$request);
    }
  
}
