<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use App\Mail\MailCongratulation;
use App\Utils\Constants\Subscription;
use App\Mail\MailSorry;
use App\Models\Application;
use App\Models\Order;
use App\Models\SubscriptionAttribute;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class UserMService
{
    public function getAllUser()
    {
        $users = User::all()->where('role', '!=', 'admin')->where('status', '=', Status::APPROVED);
        return response()->json([
            'status' => '200',
            'data' => $users
        ]);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = Status::DEACTIVE;
            $user->save();
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
        $usersCompany = User::all()->whereNotNull('status')->where('role', Role::Company)->where('status', '!=', Status::APPROVED);
        $contributors = User::all()->where('requested_to_contributor', '=', 'pending');
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
            if ($user->role == Role::User) {
                $user->requested_to_contributor = Status::APPROVED;
                $user->role = Role::Contributor;
            }
            //send mail
            $mailCon = new MailCongratulation($user);
            Mail::to($user->email)->send($mailCon);
            // đăng ký dịch vụ cho công ty
            if ($user->role == Role::Company) {
                SubscriptionAttribute::create([
                    'user_id' => $user->id,
                    'subscription_name' => Subscription::FREEMIUM,
                    // 'start_date' => now(),
                    // 'end_date' => now()->addDays(30),
                ]);
            }
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
            $mailSorry = new MailSorry($user);
            Mail::to($user->email)->send($mailSorry);
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
