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
   

    public function getOrders(Request $request)
    {
        return $this->service->getOrders($request);
    }
    public function vnpay_payment(Request $request)
    {
        return $this->service->vnpay_payment($request);
    }
    public function vnpayReturn(Request $request)
    {
        return $this->service->vnpayReturn($request);
    }
}
