<?php

namespace App\Http\Controllers\Api;

use App\Services\ParticipationService;
use Illuminate\Http\Request;

class ParticipationController
{
    private ParticipationService $service;
    public function __construct(ParticipationService $service) {
        $this->service = $service;
    }

    public function participate(Request $request) {
        return response()->json($this->service->participate($request));
    }

}
