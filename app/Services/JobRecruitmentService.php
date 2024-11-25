<?php

namespace App\Services;

use App\Http\Requests\FinishContestFormRequest;
use App\Models\Cv;
use App\Models\Application;
use App\Models\JobRecruitment;
use App\Models\Users;
use App\Utils\Constants\Status;
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
            $job->negotiable = $request->input('job.negotiable');
            if($request->input('job.negotiable') == 'true'){
                $job->negotiable = true;
                $job->salary = 0 ;
            }else{
                $job->negotiable = false;
                $job->salary = $request->input('job.salary');
            }
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
        $job = JobRecruitment::find($id);
        $profileCompany = $job->user->getCompany()->first();
        $userCompany = $profileCompany->user;
        return response()->json([
            'status' => '200',
            'data' => JobRecruitment::find($id),
            'profileCompany' => $profileCompany,
            'userCompany' => $userCompany
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
                'negotiable' =>  $request->input('job.negotiable'),
                'salary' =>  0,
                'deadline' =>  $request->input('job.deadline'),
            ]);
            if($request->input('job.negotiable') == 'true'){
                $company->negotiable = true;
                $company->salary = 0 ;
            }
            else{
                $company->negotiable = false;
                $company->salary = $request->input('job.salary');
            }
            $company->save();
            return response()->json([
                'status' => '200',
                'message' => 'Create job successfully',
                'data' => $company
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function getCVsApplied($id)
    {
       $applications = Application::where('job_id', $id)->get();
       $cvs = $applications->pluck('cv')->flatten();
       $user_cv =$applications->pluck('cv')->flatten()->pluck('user')->flatten();
       return response()->json([
           'status' => '200',
           'applications' => $applications,
           'user_cvs' => $user_cv
       ]);
    }
    public function refuseCV(Request $request)
    {
        // tìm ra job_id và cv_id
        $application = Application::where('job_id', $request->input('job_id'))->where('cv_id', $request->input('cv_id'))->first();
        $application->status = Status::REJECTED;
        $application->save();
        return response()->json([
            'status' => '200',
            'message' => 'Refuse CV successfully'
        ]);
    }
    public function approvedCV(Request $request)
    {
        $application = Application::where('job_id', $request->input('job_id'))->where('cv_id', $request->input('cv_id'))->first();
        $application->status = Status::APPROVED;
        $application->save();
        return response()->json([
            'status' => '200',
            'message' => 'Approved CV successfully'
        ]);
    }

    
}
