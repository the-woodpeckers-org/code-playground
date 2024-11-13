<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Models\ProfileCompany;
use App\Models\JobRecruitment;
class ProfileCompanyService
{
    public function getProfileCompany($id)
    {
        $profile = ProfileCompany::find($id);
        $userCompany = $profile->user()->first();
        $listJobs = JobRecruitment::where('user_id','=', $userCompany->id)->get();
        if (!$profile) {
            return response()->json(['status' => 404, 'data' => null]);
        }
        return response()->json([
            'status' => 200,
            'data' => [
                'profileCompany' => $profile,
                'userCompany' => $userCompany,
                'jobRecruitments' => $listJobs
            ]
        ]);
    }
    
    
}
