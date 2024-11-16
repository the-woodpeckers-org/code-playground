<?php

namespace App\Http\Controllers\api;

use App\Services\JobCruitmentService;
use Illuminate\Http\Request;

class JobCruitmentController
{
    //
    private JobCruitmentService $service;

    public function __construct( JobCruitmentService $jobCruitmentService) 
    {
        $this->service = $jobCruitmentService;
    }
    public function createJob(Request $request)
    {
        return $this->service->createJob($request);
    }
}
