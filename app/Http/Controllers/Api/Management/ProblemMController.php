<?php

namespace App\Http\Controllers\Api\Management;

use App\Services\Management\ProblemMService;
use Illuminate\Http\Request;

class ProblemMController
{
    //
    private ProblemMService $service;
    
    public function __construct(ProblemMService $service)
    {
        $this->service = $service;
    }
    public function getListSubscribeProblem()
    {
        return $this->service->getListSubscribeProblem();
    }

    
}
