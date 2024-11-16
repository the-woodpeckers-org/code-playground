<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Application;
class ApplicationService
{
    
    public function getJobsApplied(Request $request)
    {
        $user = $request->user();
        $listJobs = $user->getJobApplied()->with('job.user')->get()->pluck('job'); 
        return response()->json([
            'status' => '200',
            'data' => $listJobs
        ]);
    }   
   
    
}
