<?php

namespace App\Http\Controllers\Api;

use App\Services\ContestService;
use Illuminate\Http\Request;

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

    public function getAll(Request $request) {
        return response()->json($this->service->getAll($request));
    }

    public function participate(Request $request) {
        return response()->json($request->user());
    }
}
