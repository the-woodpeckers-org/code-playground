<?php

namespace App\Services;

use App\Models\Contest;
use Illuminate\Http\Request;
use App\Utils\Constants\Status;
class ContestService
{
    public function getAll(Request $request)
    {
        return Contest::paginate(8);
    }

    public function getById(Request $request)
    {
        return Contest::where("id", $request->id)->first();
    }

    public function getForLanding()
    {
        return Contest::orderBy("created_at", "desc")->where('status','=',Status::ACTIVE)->limit(3)->get();
    }

    public function getAllByContributor(Request $request)
    {
        return Contest::where('created_by', $request->user()->id)->paginate(8);
    }

    public function getContestForManage(Request $request)
    {
        $contests = Contest::where('created_by', $request->user()->id)->paginate(8);
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
                'patition' => $contest->participation,
                'change_required' => $contest->change_required,
            ];
            array_push($detailContests, $detailContest);
        }
        return response()->json(
            [
                'contests'=>$contests,
                'detailContests'=>$detailContests,
                'total'=>$contests->total(),
            ]
        );
    }
}
