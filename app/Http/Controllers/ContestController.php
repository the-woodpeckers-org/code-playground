<?php

namespace App\Http\Controllers;

use App\Services\ContestService;
use Illuminate\Http\Request;

class ContestController extends Controller
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
