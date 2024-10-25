<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaveCVFormRequest;
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
    public function getCvsU(Request $request)
    {
        return $this->service->getCvsU($request);
    }

    public function getCV(Request $request)
    {
        return $this->service->getCV($request);
    }
}
