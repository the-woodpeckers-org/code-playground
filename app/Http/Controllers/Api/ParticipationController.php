<?php

namespace App\Http\Controllers\Api;

use App\Services\ParticipantService;
use Illuminate\Http\Request;

class ParticipationController
{
    private ParticipantService $service;
    public function __construct(ParticipantService $service) {
        $this->service = $service;
    }

    public function participate(Request $request) {
        return response()->json($this->service->participant($request));
    }

}
