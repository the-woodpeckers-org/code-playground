<?php

namespace App\Http\Controllers\Api\Management;

use App\Services\Management\ContestMService;
use Illuminate\Http\Request;

class ContestMController
{
    //
    private ContestMService $service;

    public function __construct(ContestMService $service)
    {
        $this->service = $service;
    }

    public function getListSubscribeContest()
    {
        return $this->service->getListSubscribeContest();
    }
    public function approvedContest(Request $request)
    {
        return $this->service->approvedContest($request);
    }
    public function rejectContest(Request $request)
    {
        return $this->service->rejectContest($request);
    }
    public function changeRequiredContest(Request $request)
    {
        return $this->service->changeRequiredContest($request);
    }
}
