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
    public function getCVsApplied($id)
    {
        return $this->service->getCVsApplied($id);
    }
    public function refuseCV(Request $request)
    {
        return $this->service->refuseCV($request);
    }
    public function approvedCV(Request $request)
    {
        return $this->service->approvedCV($request);
    }   
    public function approvedCVUpdate(Request $request)
    {
        return $this->service->approvedCVUpdate($request);
    }
}
