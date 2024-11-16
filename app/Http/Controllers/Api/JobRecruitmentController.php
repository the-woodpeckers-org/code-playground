<?php

namespace App\Http\Controllers\api;

use App\Services\JobRecruitmentService;
use Illuminate\Http\Request;

class JobRecruitmentController
{
    //
    private JobRecruitmentService $service;

    public function __construct( JobRecruitmentService $jobCruitmentService) 
    {
        $this->service = $jobCruitmentService;
    }
    public function getJobsU(Request $request)
    {
        return $this->service->getJobsU($request);
    }

    public function getDetailJob($id)
    {
        return $this->service->getDetailJob($id);
    }
    public function updateJob(Request $request)
    {
        return $this->service->updateJob($request);
    }
    public function deleteJob($id)
    {
        return $this->service->deleteJob($id);
    }
    public function createJob(Request $request)
    {
        return $this->service->createJob($request);
    }
}
