<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ProfileUserService
{
    public function getProfileCV(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $user = User::find($userId);

            if ($user != null) {
                $profile_user = ProfileUser::where('user_id', '=', $userId)->first();

                if ($profile_user === null) {
                    return response()->json([
                        'status' => '200',
                        'user' => $user,
                        'profile' => 'null'
                    ]);
                } else {
                    return response()->json([
                        'status' => '200',
                        'user' => $user,
                        'profile' => $profile_user
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
    
}
