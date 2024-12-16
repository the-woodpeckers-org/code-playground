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
    public function vnpay_payment(Request $request)
    {
    $user = $request->user();
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://code-playground.test/checkout/vnpay-return";
        $vnp_TmnCode = "NDID0JE7";//Mã website tại VNPAY 
        $vnp_HashSecret = "K3JCPJHX5HQDSDNRZNNY0NGUK2D0OGLD"; //Chuỗi bí mật
        
        $order = new Order();
        $order->user_id = $user->id;
        $order->status = Status::PENDING;
        $order->total = 10000000;
        $order->save();
    
        $vnp_TxnRef = $order->id;

        $vnp_OrderInfo ='Checkout';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 10000000 * 100;
        $vnp_Locale ='VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
    
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =  hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }
    public function vnpayReturn(Request $request)
    {    
       $vnp_HashSecret = "K3JCPJHX5HQDSDNRZNNY0NGUK2D0OGLD";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $order = Order::find($_GET['vnp_TxnRef']);
                $order->status = Status::PAID;
                $order->save();

                $sub = new SubscriptionAttribute();
                $sub->order_id = $order->id;
                $sub->subscription_name = 'Premium';
                $sub->start_date = now();
                $sub->end_date = now()->addDays(30);
                $sub->save();
                return response()->json([
                    'status' => '200',
                    'message' => 'Thanh toán thành công',
                ]);
            } 
            else {
                echo "GD Khong thanh cong";
                }
        } else {
            echo "Chu ky khong hop le";
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
