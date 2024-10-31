<?php

namespace App\Http\Controllers;

use App\Models\Cart_item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class vnPayController extends Controller
{
    public function vnpay_payment() {
        try {

           // Lấy mảng orderIds từ session
$orderIds = session('orderIds');
$totalWithShipping = session('totalWithShipping');

// Kiểm tra xem giá trị đã tồn tại trong session hay chưa
if (!$orderIds || !$totalWithShipping) {
    return 'Không tìm thấy thông tin đơn hàng.';
}

// Tạo chuỗi từ mảng orderIds
$orderIdString = implode(',', $orderIds);
           
        // call API
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("vnpay.success");
        $vnp_TmnCode = "43MQAL12";//Mã website tại VNPAY 
        $vnp_HashSecret = "KAA3D57BUMB4IGKSKD470IUAEYD3MNDF"; //Chuỗi bí mật
        
        $vnp_TxnRef = $orderIdString; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "Thanh toán VNPAY";
        $vnp_OrderType = "Online";
        // $vnp_Amount = 100000 * 100;
        $vnp_Amount = $totalWithShipping * 100;
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


    public function success()
{
    // Lấy userId từ auth() và productIds từ session
    $userId = auth()->id();
    $productIds = session('productIds');

    // Kiểm tra xem session có chứa productIds hay không
    if (empty($productIds)) {
        return response()->json(['message' => 'Không tìm thấy sản phẩm để xóa.'], 404);
    }

    // Thực hiện xóa các CartItem với điều kiện user_id và product_id
    Cart_item::where('user_id', $userId)
        ->whereIn('product_id', $productIds)
        ->delete();

    // Xóa session productIds sau khi xóa xong
    session()->forget('productIds');

    return 'Đã xóa các sản phẩm khỏi giỏ hàng thành công.';
}

    
    
    
    
    

    
}
