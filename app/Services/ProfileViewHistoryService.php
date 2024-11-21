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
use App\Models\ProfileViewHistory;

class ProfileViewHistoryService
{
    public function addViewHistory(Request $request)
    {
        try {
            $user = $request->user();
            $profile_company = $user->getCompany()->first();
            $profile_user_id = $request->input('profile_user_id');
            $viewHistory = ProfileViewHistory::where('profile_user_id', '=', $profile_user_id)
                ->where('profile_company_id', '=', $profile_company->id)
                ->first();
                
            if ($viewHistory) {
                $viewHistory->view_count = $viewHistory->view_count + 1;
                $viewHistory->save();
            } else {
                $viewHistory = new ProfileViewHistory();
                $viewHistory->profile_user_id = $profile_user_id;
                $viewHistory->profile_company_id = $profile_company->id;
                $viewHistory->view_count = 1;
                $viewHistory->save();
            }
            return response()->json(['status' => '200', 'message' => 'Success', 'data' => $viewHistory]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Some thing error!.',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getListCompanyView(Request $request)
    {
        try {
            $user = $request->user();
            $profile_user= ProfileUser::where('user_id', '=', $user->id)->first();
             $viewHistory = ProfileViewHistory::where('profile_user_id', '=', $profile_user->id)
                ->with('profile_company.user')
                ->get();            
            return response()->json(['status' => '200', 'message' => 'Success', 'data' => $viewHistory]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Some thing error!.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
