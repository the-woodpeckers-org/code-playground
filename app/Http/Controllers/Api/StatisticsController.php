<?php

namespace App\Http\Controllers\api;

use App\Services\StatisticsSErvice;
use Illuminate\Http\Request;

class StatisticsController
{
    //
    private StatisticsService $service;
    public function __construct(StatisticsService $service)
    {
        $this->service = $service;
    }
    
    public function statistics(Request $request)
    {
        return $this->service->statistics($request);
    }
    
}
