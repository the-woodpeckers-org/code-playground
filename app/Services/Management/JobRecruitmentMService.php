<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use App\Models\JobRecruitment;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class JobRecruitmentMService
{
  public function getListJobRecruitment()
  {
    $jobs = JobRecruitment::all();
    $detailJobs = [];
    foreach ($jobs as $job) {
      $detailJobs[] = [
        'id' => $job->id,
        'user'=> $job->user,
        'title' => $job->title,
        'description' => $job->description,
        'status' => $job->status,
        'skill' => $job->skill,
        'location' => $job->location,
        'salary' => $job->salary,
        'created_at' => $job->created_at,
        'updated_at' => $job->updated_at
      ];
    }
    return response()->json([
      'status' => '200',
      'data' => $detailJobs,
      'message' => 'Get list job recruitment successfully'
    ]);
  }

  public function approvedJob($id)
  {
    $job = JobRecruitment::find($id);
    if ($job) {
      $job->status = Status::APPROVED;
        // SEND MAIL
      $job->save();
      return response()->json([
        'status' => '200',
        'message' => 'Job approved successfully'
      ]);
    } else {
      return response()->json([
        'status' => '404',
        'message' => 'Job not found'
      ]);
    }
  }

  public function rejectJob($id)
  {
    $job = JobRecruitment::find($id);
    if ($job) {
      $job->status = Status::REJECTED;
        // SEND MAIL
      $job->save();
      return response()->json([
        'status' => '200',
        'message' => 'Job rejected successfully'
      ]);
    } else {
      return response()->json([
        'status' => '404',
        'message' => 'Job not found'
      ]);
    }
  }

  public function requestJob(Request $request)
  {

  }

  public function deleteJob($id)
  {
    
  }
}
