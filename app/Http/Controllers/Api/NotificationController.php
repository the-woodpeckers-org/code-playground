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
    public function sendInviteApplyNotification(Request $request)
    {
        return $this->service->sendInviteApplyNotification($request);
    }
    public function getNotification(Request $request)
    {
        return $this->service->getNotification($request);
    }
    public function isReadNotification(Request $request)
    {
        return $this->service->isReadNotification($request);
    }
}
