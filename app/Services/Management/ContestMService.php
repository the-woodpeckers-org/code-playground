<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Models\Contest;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

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

            ];
            array_push($detailContests, $detailContest);
        }
        return response()->json([
            'status' => 'success',
            'contests' => $detailContests,
            'message' => 'Get list contest successfully'
        ]);
    }
}
