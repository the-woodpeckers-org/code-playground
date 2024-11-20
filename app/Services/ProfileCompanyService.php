<?php

namespace App\Services;

use App\Models\HiddenCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Models\ProfileCompany;
use App\Models\JobRecruitment;
use App\Models\User;
use App\Models\ProfileUser;

class ProfileCompanyService
{
    public function getCompaniesU()
    {
        $user = Auth::user(); 
        $profile_user = ProfileUser::where('user_id', '=', $user->id)->first(); 
    
        $companies = User::where('role', '=', 1)
            ->with('getCompany')
            ->get();
    
        $hiddens = HiddenCompany::where('profile_user_id', '=', $profile_user->id)
            ->pluck('profile_company_id')  
            ->toArray();

        $filteredCompanies = [];
    
        foreach ($companies as $company) {
            if($company->getCompany)
            {
                if (!in_array($company->getCompany->id, $hiddens)) {
                   $filteredCompanies[] = $company;
                }
            }
        }
    
        return response()->json([
            'status' => 200,
            'data' => $filteredCompanies, 
            'test' => $profile_user 
        ]);
    }
    
    public function getProfileCompany($id)
    {
        $profile = ProfileCompany::find($id);
        $userCompany = $profile->user()->first();
        $listJobs = JobRecruitment::where('user_id', '=', $userCompany->id)->get();
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
        $listJobs = JobRecruitment::where('user_id', '=', $userCompany->id)->get();
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
