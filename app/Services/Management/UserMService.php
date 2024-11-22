<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class UserMService
{
    public function getAllUser()
    {
        $users = User::all();
        return response()->json([
            'status' => '200',
            'data' => $users
        ]);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => '200',
                'message' => 'User deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'User not found'
            ]);
        }
    }
    
}
