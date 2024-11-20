<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Application;
use App\Models\JobRecruitment;
use App\Models\HiddenCompany;
use App\Models\ProfileUser;
class HiddenCompanyService
{
        public function addHiddenCompany(Request $request)
        {
            try{
                $user = $request->user();
                $profile_user = ProfileUser::where('user_id', '=', $user->id)->first();
                $profile_user_id = $profile_user->id; 
                $profile_company_id = $request->input('profile_company_id');

                $hiddenCompany = new HiddenCompany();
                $hiddenCompany->profile_user_id = $profile_user_id;
                $hiddenCompany->profile_company_id = $profile_company_id;
                $hiddenCompany->save();
                return response()->json([
                    'status' => '200',
                    'message' => 'Success',
                    'data' => $hiddenCompany
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'status' => '500',
                    'message' => 'You have not completed setting up your personal information.',
                    'error' => $e->getMessage()
                ]);
            }
        }
}
