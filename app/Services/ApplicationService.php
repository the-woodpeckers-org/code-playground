<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Application;
use App\Models\JobRecruitment;

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
   
    public function applyCV(Request $request)
    {
        $user = $request->user();   
        if($user->role!=null){
            return response()->json([
                'status' => '400',
                'message' => 'You are not allowed to apply for a job'
            ]);
        }
        
        $jobId = $request->input('job_id');
        $cv_id = $request->input('cv_id');
        $letter = $request->input('letter');
        $user_company = JobRecruitment::where('id', $jobId)->first()->user()->first();
        $application = new Application();
        $application->user_id = $user_company->id;
        $application->job_id = $jobId;
        $application->cv_id = $cv_id;
        $application->letter = $request->input('job.letter');
        $application->save();
        return response()->json([
            'status' => '200',
            'data' => $application
        ]);
    }
    
}
