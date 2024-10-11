<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class vnPayController extends Controller
{
    public function vnpay_payment() {
        try {

           // Lấy order_ids từ session
           $orderIds = session('order_ids');

           // Kiểm tra xem order_ids có tồn tại không
           if (is_null($orderIds)) {
               return response()->json(['message' => 'Đơn hàng không được tìm thấy trong session.'], 404);
           }
           
           // Kiểm tra xem order_ids có phải là một mảng hay không, nếu không thì biến thành mảng
           if (!is_array($orderIds)) {
               $orderIds = [$orderIds]; // Chuyển thành mảng nếu chỉ có một order_id
           }
           
           // Biến các order_ids thành một chuỗi, cách nhau bằng dấu phẩy
           $orderIdsString = implode(',', $orderIds);
           
           // Lấy tất cả đơn hàng dựa vào order_ids
           $orders = Order::whereIn('id', $orderIds)->get();
           
           // Kiểm tra xem có đơn hàng nào không
           if ($orders->isEmpty()) {
               return response()->json(['message' => 'Không tìm thấy đơn hàng nào.'], 404);
           }
           
           // Khởi tạo biến tổng `total_amount`
           $totalAmount = 0;
           
           // Lấy phí vận chuyển từ session
           $shippingFee = session('shipping_fee', 0); // Nếu không có giá trị, mặc định là 0
           
           // Lấy các giá trị cần thiết cho từng đơn hàng và tính tổng
           foreach ($orders as $order) {
               $id = $order->id;
               $total = $order->total;
               $paymentMethod = $order->payment_method;
           
               // Cộng dồn giá trị `total` vào `totalAmount`
               $totalAmount += $total;
           }
           
           // Cộng phí vận chuyển vào tổng
           $totalAmount += $shippingFee;
           
           // Tiếp tục các thao tác thanh toán tại đây (VD: gọi API VNPay)
           // ...
           
           
        // call API
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("success");
        $vnp_TmnCode = "43MQAL12";//Mã website tại VNPAY 
        $vnp_HashSecret = "KAA3D57BUMB4IGKSKD470IUAEYD3MNDF"; //Chuỗi bí mật
        
        $vnp_TxnRef = $orderIdsString; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "Thanh toán VNPAY";
        $vnp_OrderType = $paymentMethod;
        // $vnp_Amount = 100000 * 100;
        $vnp_Amount = $totalAmount * 100;
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
        $orderIds = session('order_ids');
    
        if (is_null($orderIds)) {
            echo 'Không tìm thấy đơn hàng.';
            return;
        }
    
        // Kiểm tra xem order_ids có phải là mảng không
        if (!is_array($orderIds)) {
            $orderIds = [$orderIds]; // Chuyển thành mảng nếu chỉ có một order_id
        }
    
        // Khởi tạo biến để lưu thông báo
        $successMessage = '';
        $errorMessage = '';
    
        // Lặp qua tất cả các order_id để cập nhật trạng thái
        foreach ($orderIds as $orderId) {
            // Cập nhật trạng thái thanh toán cho đơn hàng
            $order = Order::find($orderId);
            
            if ($order) {
                $successMessage .= 'Đơn hàng ID ' . $orderId . ': Trạng thái hiện tại: ' . $order->payment_status . '. '; // Kiểm tra trạng thái hiện tại
                $order->payment_status = 'paid'; // Cập nhật payment_status
    
                // Kiểm tra xem lưu có thành công hay không
                if ($order->save()) {
                    // Lấy danh sách product_id từ bảng order_items dựa trên order_id
                    $productIds = OrderItem::where('order_id', $orderId)->pluck('product_id')->toArray();
                    
                    // Lấy userId từ Auth
                    $userId = Auth::id();
    
                    if (!empty($productIds) && !is_null($userId)) {
                        // Xóa các sản phẩm trong cart dựa trên user_id và product_id
                        DB::table('carts') // Sử dụng DB
                            ->where('user_id', $userId)
                            ->whereIn('product_id', $productIds)
                            ->delete();
    
                        $successMessage .= 'Thanh toán thành công và giỏ hàng đã được làm trống cho đơn hàng ID ' . $orderId . '! ';
                    } else {
                        $errorMessage .= 'Không có sản phẩm để xóa trong giỏ hàng cho đơn hàng ID ' . $orderId . '. ';
                    }
                } else {
                    $errorMessage .= 'Không thể cập nhật trạng thái thanh toán cho đơn hàng ID ' . $orderId . '. ';
                }
            } else {
                $errorMessage .= 'Đơn hàng ID ' . $orderId . ' không tồn tại. ';
            }
        }
    
        // Xóa session order_ids
        session()->forget('order_ids');
    
        // Hiển thị thông báo
        echo $successMessage ?: $errorMessage;
    }
    
    
    
    
    

    
}
