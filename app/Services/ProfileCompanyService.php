<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Models\ProfileCompany;
use App\Models\JobRecruitment;
use App\Models\User;

class ProfileCompanyService
{
    public function getCompanies()
    {
        $companies = User::where('role','=', 1)
        ->with('getCompany')
        ->get();

    return response()->json([
        'status' => 200,
        'data' => $companies
    ]);

    }
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
    public function getProfileCompanyByUserId(Request $request)
    {
        $user_id = Auth::user()->id;
        $profile = ProfileCompany::where('user_id', $user_id)->first();
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
    // 'user_id',
    // 'description',
    // 'general_information',
    // 'address',
    // 'phone',
    // 'email',
    // 'skill',
    public function updateProfileCompany(Request $request)
    {
        $profile = ProfileCompany::where('user_id', Auth::user()->id)->first();
        if (!$profile) {
            return response()->json(['status' => 404, 'data' => null]);
        }           

        $profile->description = $request->input('profileCompany.description');
        $profile->general_information = $request->input('profileCompany.general_information');
        $profile->address = $request->input('profileCompany.address');
        $profile->phone = $request->input('profileCompany.phone');
        $profile->email = $request->input('profileCompany.email');
        $profile->skill = $request->input('profileCompany.skill');
        $profile->save();
        return response()->json([
            'status' => 200,
            'data' => $profile
        ]);
    }
    
}
