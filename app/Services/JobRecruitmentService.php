<?php

namespace App\Services;

use App\Http\Requests\FinishContestFormRequest;
use App\Models\Participation;
use App\Models\JobRecruitment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobRecruitmentService
{
    public function getJobsU(Request $request)
    {
        $user = $request->user();
        try{
            $jobs = JobRecruitment::where('user_id', $user->id)->get();
            return response()->json([
                'status' => '200',
                'data' => $jobs
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
       
    }
    public function updateJob(Request $request)
    {
        try{
            $id = $request->input('job.id');
           $job = JobRecruitment::find($request->input('job.id'));
            $job->title = $request->input('job.title');
            $job->description = $request->input('job.description');
            $job->skill = $request->input('job.skill');
            $job->description = $request->input('job.description');
            $job->location =$request->input('job.location');
            $job->salary = $request->input('job.salary');
            $job->deadline = $request->input('job.deadline');
            $job->save();
            return response()->json([
                'status' => '200',
                'data' => $job
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function deleteJob($id)
    {
        try{
            $job = JobRecruitment::find($id);
            $job->delete();
            return response()->json([
                'status' => '200',
                'message' => 'Job deleted'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function getDetailJob($id)
    {
        return response()->json([
            'status' => '200',
            'data' => JobRecruitment::find($id)
        ]);
    }
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
