<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class vnPayController extends Controller
{
    public function vnpay_payment() {
        try {
            // Lấy order_id từ session
            $orderId = session('order_id');
    
            // Kiểm tra xem order_id có tồn tại không
            if (is_null($orderId)) {
                return response()->json(['message' => 'Đơn hàng không được tìm thấy trong session.'], 404);
            }
    
            // Truy vấn đến bảng orders để lấy thông tin đơn hàng
            $order = Order::find($orderId);
    
            // Kiểm tra xem đơn hàng có tồn tại không
            if (!$order) {
                return response()->json(['message' => 'Đơn hàng không tồn tại.'], 404);
            }
    
            // Lấy các giá trị cần thiết
            $id = $order->id;
            $total = $order->total;
            $paymentMethod = $order->payment_method;
    
            // Thực hiện các thao tác thanh toán tại đây (VD: gọi API VNPay)
    
           
        // call API
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("success");
        $vnp_TmnCode = "43MQAL12";//Mã website tại VNPAY 
        $vnp_HashSecret = "KAA3D57BUMB4IGKSKD470IUAEYD3MNDF"; //Chuỗi bí mật
        
        $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "Thanh toán VNPAY";
        $vnp_OrderType = $paymentMethod;
        // $vnp_Amount = 100000 * 100;
        $vnp_Amount = $total * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
         
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
            "vnp_TxnRef" => $vnp_TxnRef,
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    
            
        } catch (\Exception $e) {
            // Ghi lỗi vào log và trả về thông báo lỗi
            \Log::error('Lỗi trong vnpay_payment: ' . $e->getMessage());
            return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }


    public function success() {
            // Lấy id đơn hàng từ session
            $orderId = session('order_id');
    
            if (is_null($orderId)) {
                echo 'Không tìm thấy đơn hàng.';
                return;
            }
    
            // Cập nhật trạng thái thanh toán cho đơn hàng
            $order = Order::find($orderId);
    
            if ($order) {
                echo 'Trạng thái hiện tại: ' . $order->payment_status; // Kiểm tra trạng thái hiện tại
                $order->payment_status = 'paid'; // Cập nhật payment_status
                
                // Kiểm tra xem lưu có thành công hay không
                if ($order->save()) {
                    session()->forget('order_id');
                    echo 'Thanh toán thành công!';
                } else {
                    echo 'Không thể cập nhật trạng thái thanh toán.';
                }
            } else {
                echo 'Đơn hàng không tồn tại.';
            }       
    }
    
    
    


    
    
    
}
