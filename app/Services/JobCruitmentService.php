<?php

namespace App\Services;

use App\Http\Requests\FinishContestFormRequest;
use App\Models\Participation;
use App\Models\JobRecruitment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobCruitmentService
{
    public function createJob(Request $request)
    {
        $user = $request->user();
        try {
            $company = JobRecruitment::create([
                'user_id' => $user->id,
                'title' =>  $request->input('job.title'),
                'location' =>  $request->input('job.location'),
                'description' =>  $request->input('job.description'),
                'skill' =>  $request->input('job.skill'),
                'salary' =>  $request->input('job.salary'),
                'deadline' =>  $request->input('job.deadline'),
            ]);
           
            return response()->json([
                'status' => '200',
                'data' => $company
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
}
