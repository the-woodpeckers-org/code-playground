<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CvService;

class CvController
{
    private CvService $service;
    //
    public function __construct(CvService $_service)
    {
        $this->service = $_service;
    }
    public function newCV()
    {
        return $this->service->newCV();
    }
    public function saveCV(Request $request)
    {
        return $this->service->saveCV($request);
    }
}
