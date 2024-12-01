<?php

namespace App\Services\Management;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Utils\Constants\Status;
use App\Utils\Constants\Role;
use Illuminate\Http\Request;
use App\Models\JobRecruitment;
use App\mail\MailSendRequestChange;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailResponseReview;
use App\Models\Notification;
use Mockery\Matcher\Not;
use App\Models\Order;
use App\Models\SubscriptionAttribute;
use App\Utils\Constants\Subscription;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class OrderService
{
    public function registerPremium(Request $request)
    {
        try {


            $user = $request->user();
            $order = new Order();
            $order->user_id = $user->id;
            $order->status = Status::PAID;
            $order->total = 1000000;
            $order->save();

            $subs = new SubscriptionAttribute();
            $subs->order_id = $order->id;
            $subs->subscription_name = Subscription::PREMIUM;
            $subs->start_date = now();
            $subs->end_date = now()->addMonth();
            $subs->save();

            return response()->json([
                'status' => '200',
                'message' => 'Register Premium Success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getOrders(Request $request)
    {
        $user = $request->user();
        try {
            $orders = Order::where('user_id', $user->id)->get();
            return response()->json([
                'status' => '200',
                'data' => $orders,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage()
            ]);
        }
    }
}
