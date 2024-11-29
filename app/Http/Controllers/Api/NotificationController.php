<?php

namespace App\Http\Controllers\Api;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController
{
    private NotificationService $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }
}
