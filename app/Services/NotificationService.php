<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailInviteApply;
use App\Models\User;
use App\Models\JobRecruitment;
use App\Models\Notification;

class NotificationService
{

    public function sendInviteApplyNotification(Request $request) {
        try{
            $job = JobRecruitment::find($request->job_id)->first();
            // invited_user,$user_company,$job,$contest
            $invited_user = User::find($request->input('user_invited'))->first();
            $user_company = request()->user();
            $contest = $job->contest;
            Mail::to($request->email)->send(new MailInviteApply($invited_user,$user_company,$job,$contest));
    
            $notification = new Notification();
            $notification->type = "Invite";
            $notification->user_id = $request->input('user_invited');
            $notification->message="You have been invited to apply for a job";
            $notification->isRead= false;
            $notification->fid = $user_company->id;
            $notification->save();
    
            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => 'Email not sent'], 500);
        }
        
    }
}
