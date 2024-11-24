<?php

namespace App\Http\Controllers\Api\Management;

use Illuminate\Http\Request;
use App\Services\Management\JobRecruitmentMService;
class JobRecruitmentMController
{
    //
    private JobRecruitmentMService $service;

    public function __construct(JobRecruitmentMService $_serivce)
    {
        $this->service = $_serivce;
    }

    public function getListJobRecruitment()
    {
        return $this->service->getListJobRecruitment();
    }

    public function approvedJob($id)
    {
        return $this->service->approvedJob($id);
    }
    public function rejectJob($id)
    {
        return $this->service->rejectJob($id);
    }

    public function sendRequestChangeJob(Request $request)
    {
        return $this->service->sendRequestChangeJob($request);
    }

    
}
