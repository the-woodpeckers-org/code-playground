<?php

namespace App\Services;

use App\Http\Requests\FinishContestFormRequest;
use App\Models\Cv;
use App\Models\Application;
use App\Models\JobRecruitment;
use App\Models\SubscriptionAttribute;
use App\Models\Users;
use App\Mail\MailResponseCV;
use App\Utils\Constants\Subscription;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Utils\Constants\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobRecruitmentService
{
    public function getJobsU(Request $request)
    {
        $user = $request->user();
        try {
            $jobs = JobRecruitment::where('user_id', $user->id)->get();
            $order_user = Order::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $maxPost = null;
            $subUser = null;
            if ($order_user) {
                $subUser = SubscriptionAttribute::where('order_id', $order_user->id)->where('end_date', '>', Carbon::now())->first();
                if ($subUser && $subUser->subscription_name === Subscription::PREMIUM) {
                    $maxPost = Subscription::PREMIUMPOST;
                }
            } else {
                $maxPost = Subscription::FREEPOST;
            }

            return response()->json([
                'status' => '200',
                'data' => $jobs,
                'maxPost' => $maxPost,
                'subUser' => $subUser,
                
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function updateJob(Request $request)
    {
        try {
         
            $job = JobRecruitment::find($request->input('job.id'));
            $job->title = $request->input('job.title');
            $job->description = $request->input('job.description');
            $job->skill = $request->input('job.skill');
            $job->description = $request->input('job.description');
            $job->location = $request->input('job.location');
            $job->position_number = $request->input('job.position_number');
            $job->negotiable = filter_var($request->input('job.negotiable'), FILTER_VALIDATE_BOOLEAN);
            if ($job->negotiable) {
                $job->salary = 0; 
            } else {
                $job->salary = $request->input('job.salary');
            }
            
            $job->deadline = $request->input('job.deadline');
            $job->save();
            return response()->json([
                'status' => '200',
                'data' => $job
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function deleteJob($id)
    {
        try {
            $job = JobRecruitment::find($id);
            $job->delete();
            return response()->json([
                'status' => '200',
                'message' => 'Job deleted'
            ]);
        } catch (\Exception $e) {
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
            $countTemp = $user->getJobPosted()->count();
            $countMax = null;            
            $order = Order::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            if ($order) {

                if (SubscriptionAttribute::where('order_id', $order->id)->first()) {
                    $countMax = Subscription::PREMIUMPOST;
                }
            } else {
                $countMax = Subscription::FREEPOST;
                if ($countTemp >= $countMax) {
                    return response()->json([
                        'status' => '5900',
                        'message' => 'You have reached the maximum number of job posts',
                        'order' => $order
                    ]);
                }
            }
            
            $company = JobRecruitment::create([
                'user_id' => $user->id,
                'title' =>  $request->input('job.title'),
                'location' =>  $request->input('job.location'),
                'description' =>  $request->input('job.description'),
                'skill' =>  $request->input('job.skill'),
                'negotiable' =>  $request->input('job.negotiable'),
                'salary' =>  0,
                'position_number' =>  $request->input('job.position_number'),
                'deadline' =>  $request->input('job.deadline'),
            ]);
            if ($request->input('job.negotiable') == 'true') {
                $company->negotiable = true;
                $company->salary = 0;
            } else {
                $company->negotiable = false;
                $company->salary = $request->input('job.salary');
            }
            $company->save();
            return response()->json([
                'status' => '200',
                'message' => 'Create job successfully',
                'data' => $company,
                'countTemp' => $countMax,
                'order' => $order
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
        $user_cv = $applications->pluck('cv')->flatten()->pluck('user')->flatten();
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
        //send mail thông báo cho user
        Mail::to($application->cv->user->email)->send(new MailResponseCV($application->cv->user, $application->job->user->getCompany()->first()->user, $application->job, Status::REJECTED));
        Notification::create([
            'user_id' => $application->cv->user->id,
            'message' => 'Your CV has been refused by ' . $application->job->user->getCompany()->first()->user->name . ' with Job ' . $application->job->title,
            'type' => 'Refuse CV',
            'fid' => $application->job->user->getCompany()->first()->user->id,
            'is_read' => false
        ]);
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
        Mail::to($application->cv->user->email)->send(new MailResponseCV($application->cv->user, $application->job->user->getCompany()->first()->user, $application->job, Status::APPROVED));
        Notification::create([
            'user_id' => $application->cv->user->id,
            'message' => 'Your CV has been approved by ' . $application->job->user->getCompany()->first()->user->name . ' with Job ' . $application->job->title,
            'type' => 'Approved CV',
            'fid' => $application->job->user->getCompany()->first()->user->id,
            'is_read' => false
        ]);
        return response()->json([
            'status' => '200',
            'message' => 'Approved CV successfully'
        ]);
    }

    public function approvedCVUpdate(Request $request)
    {
        $application = Application::where('job_id', $request->input('job_id'))->where('cv_id', $request->input('cv_id'))->first();
        $job = JobRecruitment::where('id', '=', $request->input('job_id'))->first();
        $job->position_number = $request->input('numberUpdate');
        $job->save();
        $application->status = Status::APPROVED;
        $application->save();
        //send mail thông báo cho user
        Mail::to($application->cv->user->email)->send(new MailResponseCV($application->cv->user, $application->job->user->getCompany()->first()->user, $application->job, Status::APPROVED));
        Notification::create([
            'user_id' => $application->cv->user->id,
            'message' => 'Your CV has been approved by ' . $application->job->user->getCompany()->first()->user->name . ' with Job ' . $application->job->title,
            'type' => 'Approved CV',
            'fid' => $application->job->user->getCompany()->first()->user->id,
            'is_read' => false
        ]);
        return response()->json([
            'status' => '200',
            'message' => 'Approved CV successfully'
        ]);
    }
}
