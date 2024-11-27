<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Models\Problem;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSendRequestChange;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class ProblemMService
{
    public function getListProblem()
    {
        
    }
    public function getListSubscribeProblem(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 8; // Số bản ghi mỗi trang
    
        $skip = ($page - 1) * $perPage;
    
        $problems = Problem::skip($skip)->take($perPage)->where('status','=',Status::ACTIVE)->get();
        $detailProblems = $problems->map(function ($problem) {
            return [
                'id' => $problem->id,
                'title' => $problem->title,
                'description' => $problem->description,
                'difficulty' => $problem->difficulty,
                'status' => $problem->status,
                'created_by' => $problem->user,
                'created_at' => $problem->created_at,
                'updated_at' => $problem->updated_at,
                'languages' => $problem->languages,
                'categories' => $problem->categories,
                'testcases' => $problem->testcases,
                'change_required' => $problem->change_required,
            ];
        });
        $total = Problem::all()->where('status','=',Status::ACTIVE)->count();
        
        return response()->json([
            'status' => '200',
            'data' => $detailProblems,
            'pagination' => [
                'total' => $total, 
                'per_page' => $perPage, 
                'current_page' => $page, 
                'last_page' => ceil($total / $perPage), 
                'next_page_url' => $page < ceil($total / $perPage) ? url()->current() . '?page=' . ($page + 1) : null,
                'prev_page_url' => $page > 1 ? url()->current() . '?page=' . ($page - 1) : null, // URL trang trước đó
            ],
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

    public function ChangeRequestProblem(Request $request)
    {
        $problem = Problem::find($request->input('problem_id'));
        if($problem)
        {
            $problem->change_required = $request->input('change_required');
            $problem->save();
            $currentUser = $problem->user;
            Mail::to($currentUser->email)->send(new MailSendRequestChange($currentUser, $request->input('change_required')));
            return response()->json([
                'status' => '200',
                'message' => 'Change request problem successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'Problem not found',
                'error' => 'Have a problem with this problem'
            ]);
        }

    }
}
