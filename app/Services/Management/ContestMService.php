<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Models\Contest;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailResponseReview;
use App\Mail\MailSendRequestChange;
use App\Models\Notification;

class ContestMService
{
    public function getListSubscribeContest()
    {
        $contests = Contest::all()->whereNotNull('status')->where('status', '!=', Status::APPROVED);
        $detailContests = [];
        foreach ($contests as $contest) {
            $detailContest = [
                'id' => $contest->id,
                'title' => $contest->title,
                'description' => $contest->description,
                'problems' => $contest->problems,
                'start_date' => $contest->start_date,
                'end_date' => $contest->end_date,
                'status' => $contest->status,
                'created_by' => $contest->user,
                'created_at' => $contest->created_at,
                'imgUrl' => $contest->imgUrl,
                'change_required' => $contest->change_required,
                'tags'=>$contest->tags,
                'languages'=>$contest->languages,
            ];
            array_push($detailContests, $detailContest);
        }
        return response()->json([
            'status' => 'success',
            'contests' => $detailContests,
            'message' => 'Get list contest successfully'
        ]);
    }

    public function approvedContest(Request $request)
    {
        $contest = Contest::find($request->input('contest_id'));
        if ($contest == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contest not found'
            ]);
        }
        $contest->status = Status::APPROVED;
        $contest->save();
        Mail::to($contest->user->email)->send(new MailResponseReview($contest->user,null,null,$contest,Status::APPROVED));
        Notification::create([
            'user_id' => $contest->user->id,
            'message' => 'Your'. $contest->title .' has been approved by admin',
            'type' => 'Contest',
            'fid' => 0,
            'is_read' => false
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Approve contest successfully'
        ]);
    }
    public function rejectContest(Request $request)
    {
        $contest = Contest::find($request->input('contest_id'));
        if ($contest == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contest not found'
            ]);
        }
        $contest->status = Status::REJECTED;
        $contest->save();
        Mail::to($contest->user->email)->send(new MailResponseReview($contest->user,null,null,$contest,Status::REJECTED));
        Notification::create([
            'user_id' => $contest->user->id,
            'message' => 'Your'. $contest->title .' has been rejected by admin',
            'type' => 'Contest',
            'fid' => 0,
            'is_read' => false
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Reject contest successfully'
        ]);
    }
    public function changeRequiredContest(Request $request)
    {
        $contest = Contest::find($request->input('contest_id'));
        if ($contest == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contest not found'
            ]);
        }
        $contest->change_required = $request->input('change_required');
        $contest->save();
        $current_user = $contest->user;
        Mail::to($current_user->email)->send(new MailSendRequestChange($current_user, $request->input('change_required')));
        Notification::create([
            'user_id' => $contest->user->id,
            'message' => 'Your'. $contest->title .' has been required change by admin',
            'type' => 'Contest',
            'fid' => 0,
            'is_read' => false
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Change required contest successfully'
        ]);
    }
}
