<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\HiddenCompany;
use App\Models\ProfileCompany;
class ProfileUserService
{
    public function getProfileCV(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $user = User::find($userId);

            if ($user != null) {
                $profile_user = ProfileUser::where('user_id', '=', $userId)->first();
                $cvPrimary = $user->getCVPrimary()->first();
                $listCompanyHidden = HiddenCompany::where('profile_user_id', '=', $profile_user->id)->get();
                $companyIds = $listCompanyHidden->pluck('profile_company_id');
                $companies = ProfileCompany::whereIn('id', $companyIds)->with('user')->get();         
                if ($profile_user === null) {
                    return response()->json([
                        'status' => '200',
                        'user' => $user,
                        'cv' => $cvPrimary,
                        'profile' => 'null'
                    ]);
                } else {
                    return response()->json([
                        'status' => '200',
                        'user' => $user,
                        'profile' => $profile_user,
                        'cv' => $cvPrimary,
                        'hiddenCompanies' => $companies
                        
                    ]);
                }
            } else {
                return response()->json([
                    'status' => '404',
                    'message' => 'user_null'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function updateProfileCV(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $profile_user = ProfileUser::where('user_id', '=', $user_id)->first();
            if ($profile_user === null) {
                $profile_user = new ProfileUser();
                $profile_user->user_id = $user_id;
            }
            $user = User::find($user_id);
            $user->birthday = $request->input('user.birthday');
            $user->gender = $request->input('user.gender');
            $user->address = json_encode($request->input('user.address'));
            $profile_user->experience = $request->input('profile.experience');
            $profile_user->job_position = $request->input('profile.job_position');
            $profile_user->skill = $request->input('profile.skill');
            $profile_user->social = $request->input('profile.social');
            $user->save();
            $profile_user->save();

            return response()->json([
                'status' => '200',
                'message' => 'Update Profile Success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function setActiveProfile(Request $request)
    {
        $user = request()->user();
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
        ]);
    }
    public function getUserCVToView($id)
    {
        try {
            $user_view = User::find($id);
            $user = Auth::user();
            $company = ProfileCompany::where('user_id', '=', $user->id)->first();
            if ($user_view != null) {
                $cv = $user_view->getCVPrimary()->get();
                $userProfile = ProfileUser::where('user_id', '=', $id)->first();
                $hidden = HiddenCompany::where('profile_user_id', '=', $userProfile->id)->where('profile_company_id', '=', $company->id)->first();
                if ($hidden != null) {
                    return response()->json([
                        'status' => '200',
                        'user' => $user_view,
                        'cv' => $cv,
                        'profile' => $userProfile,
                        'hidden' => true
                    ]);
                }
                return response()->json([
                    'status' => '200',
                    'user' => $user_view,
                    'cv' => $cv,
                    'profile' => $userProfile,
                    'company'=> $user
                ]);
            } else {
                return response()->json([
                    'status' => '404',
                    'message' => 'user_null'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ]);
        }
    }
}
