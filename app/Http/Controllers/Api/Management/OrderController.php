<?php

namespace App\Http\Controllers\Api\Management;
use App\Services\Management\OrderService;
use Illuminate\Http\Request;

class OrderController
{
    //
    private OrderService $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }
   
    public function registerPremium(Request $request)
    {
        return $this->service->registerPremium($request);
    }
}
