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
            $job = JobRecruitment::find($request->input('job_id'))->first();
            $invited_user = User::find($request->input('user_invited'))->first();
            $user_company =  User::find($request->user()->id);

            Mail::to($invited_user->email)->send(new MailInviteApply($invited_user,$user_company,$job));
    
            $notification = new Notification();
            $notification->type = "Invite";
            $notification->user_id = $request->input('user_invited');
            $notification->message="You have been invited to apply for a job";
            $notification->is_read= false;
            $notification->fid = $user_company->id;
            $notification->save();
    
            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => 'Email not sent','error'=>$e], 500);
        }
        
    }
    public function getNotification(Request $request) {
        $notifications = Notification::where('user_id', $request->user()->id)->get();
        return response()->json(['notifications' => $notifications], 200);
    }

    public function isReadNotification(Request $request)
    {
        $notification = Notification::find($request->input('notification_id'));
        $notification->is_read = true;
        $notification->save();
        return response()->json(['message' => 'Notification read'], 200);
    }
}
