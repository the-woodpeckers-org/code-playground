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
}
