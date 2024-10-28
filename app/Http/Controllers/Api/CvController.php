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
    public function newCV(Request $request)
    {   
        try {
            $request->validate([
                'title' => 'required',         
            ]);
            return $this->service->newCV($request);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'fail',
            ]);
        }
      

    
    }
    public function saveCV(Request $request)
    {
        return $this->service->saveCV($request);
    }
    public function getCvsU(Request $request)
    {
        return $this->service->getCvsU($request);
    }

    public function getCV($id)
    {
        return $this->service->getCV($id);
    }
    public function deleteCV($id)
    {
        return $this->service->deleteCV($id);
    }
}
