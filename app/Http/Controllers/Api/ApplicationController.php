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
   
}
