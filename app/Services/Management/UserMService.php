<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class UserMService
{
    public function getAllUser()
    {
        $users = User::all()->where('role','!=','admin');
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
    
    public function getListSubscribe()
    {
        $usersCompany = User::all()->whereNotNull('status')->where('role',Role::Company);
        $contributors = User::all()->whereNotNull('status')->where('role',Role::Contributor);
        $profileCompanies = $usersCompany->map(function ($user) {
            return $user->getCompany;
        });
        return response()->json([
            'status' => '200',
            'companies' => $usersCompany,
            'contributors' => $contributors,
        ]);
    }

    public function approvedSubscribe($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = Status::APPROVED;
            $user->save();
            return response()->json([
                'status' => '200',
                'message' => 'User approved successfully'
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'User not found'
            ]);
        }
    }

    public function rejectSubscribe($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = Status::REJECTED;
            $user->save();
            return response()->json([
                'status' => '200',
                'message' => 'User refused successfully'
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'User not found'
            ]);
        }
    }
}
