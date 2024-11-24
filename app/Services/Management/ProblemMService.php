<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Models\Problem;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class ProblemMService
{
    public function getListProblem()
    {
        
    }
    public function getListSubscribeProblem()
    {
        $problems = Problem::all();
        $detailProblems = [];
        foreach ($problems as $problem) {
            $detailProblem = [
                'id' => $problem->id,
                'title' => $problem->title,
                'description' => $problem->description,
                'difficulty' => $problem->difficulty,
                'status' => $problem->status,
                'created_by'=> $problem->user,
                'created_at' => $problem->created_at,
                'updated_at' => $problem->updated_at,
                'change_required' => $problem->change_required,
            ];
            array_push($detailProblems, $detailProblem);
        }
        return response()->json([
            'status' => '200',
            'data' => $detailProblems,
            'message' => 'Get list problem successfully'
        ]);
    }

    public function approvedProblem($id)
    {
        $problem = Problem::find($id);
        if ($problem) {
            $problem->status = Status::APPROVED;
            // SEND MAIL
            $problem->save();
            return response()->json([
                'status' => '200',
                'message' => 'Problem approved successfully'
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'Problem not found'
            ]);
        }
    }
}
