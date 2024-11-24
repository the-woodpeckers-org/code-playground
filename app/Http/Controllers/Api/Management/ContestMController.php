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
        return response()->json($this->service->getListSubscribeContest());
    }
}
