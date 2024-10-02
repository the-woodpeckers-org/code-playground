<?php

namespace App\Http\Controllers\Api;

use App\Services\ContestService;

class ContestController
{
    private ContestService $service;

    public function __construct(ContestService $service) {
        $this->service = $service;
    }

    public function get($id) {
        return response()->json($this->service->getById($id));
    }

    public function getLanding() {
        return response()->json($this->service->getForLanding());
    }
}
