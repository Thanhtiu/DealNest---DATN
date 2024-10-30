<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Address;
use App\Models\Cart_item;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
    
        // Lấy địa chỉ mặc định của người dùng
        $userAddress = Address::where('user_id', $userId)->where('active', 1)->first();
    
        // Lấy các product_id từ request
        $productIds = $request->input('cartIdtem', []);
    
        // Lấy các sản phẩm từ bảng Cart_item dựa trên product_id trong mảng productIds
        $products = Cart_item::whereIn('id', $productIds)->get();
    
        // Lấy danh sách voucher dựa trên product_id từ các sản phẩm
        $voucherIds = $products->pluck('product_id')->toArray();
        $vouchers = Voucher::whereIn('product_id', $voucherIds)->get()->groupBy('product_id'); // Nhóm voucher theo product_id
    
       
        return view('client.checkout', compact('products', 'userAddress', 'vouchers'));
    }


    public function checkoutProcessing(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'cartItemIds' => 'required|array',
            'totalPayment' => 'required|numeric',
        ]);
    
        // Lấy dữ liệu từ request
        $cartItemIds = $request->input('cartItemIds');
        $totalPayment = $request->input('totalPayment');
    
        $paymentMethod = $request->input('paymentMethod') ?: 'cod'; // Nếu không có phương thức thanh toán thì mặc định là 'cod'
    
        // Truy vấn dữ liệu của các CartItem dựa vào IDs và lấy seller_id từ product
        $cartItems = Cart_item::with('product') // Sử dụng eager loading để lấy thông tin product
            ->whereIn('id', $cartItemIds)
            ->get();
    
        // Kiểm tra xem có CartItem nào không
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'], 404);
        }
    
        // Nhóm các sản phẩm theo seller_id
        $groupedItems = $cartItems->groupBy(function($item) {
            return $item->product->seller_id; // Nhóm theo seller_id
        });
    
        // Khởi tạo mảng để lưu thông tin đơn hàng đã tạo
        $orders = [];
        $totalOrders = $groupedItems->count();
        $shippingFee = 15000; // Phí ship cố định là 15k 
    
        foreach ($groupedItems as $sellerId => $items) {
            // Tính tổng tiền cho đơn hàng
            $orderTotal = $items->sum(function($item) {
                return $item->total_price * $item->quantity; // Tính tổng cho từng sản phẩm
            });
    
            // Tính phí ship cho đơn hàng này
            $orderShippingFee = $shippingFee / $totalOrders; // Chia đều phí ship cho từng đơn hàng
            $totalWithShipping = $orderTotal + $orderShippingFee; // Tổng tiền đơn hàng bao gồm phí ship
    
            // Tạo đơn hàng mà không cần seller_id
            $order = Order::create([
                'user_id' => auth()->id(), // Hoặc ID người dùng hiện tại
                'status' => 'pending', // Hoặc trạng thái mặc định khác
                'total' => $totalWithShipping, // Tổng tiền bao gồm phí ship
                'delivery_date' => now()->addDays(7), // Ví dụ: giao hàng trong 7 ngày
                'payment_method' => $paymentMethod, // Hoặc phương thức thanh toán khác
                'payment_status' => 'pending', // Trạng thái thanh toán
            ]);
    
            // Lưu thông tin đơn hàng
            $orders[] = $order;
    
            // Lưu vào session orderId và totalWithShipping (chỉ lấy cái đầu tiên)
            if (count($orders) === 1) {
                session(['orderId' => $order->id, 'totalWithShipping' => $totalPayment]);
            }
    
            // Tạo order items cho từng sản phẩm
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'size' => $item->size, // Nếu có trường size
                    'color' => $item->color, // Nếu có trường color
                    'quantity' => $item->quantity,
                    'total' => $item->total_price * $item->quantity, // Tính tổng tiền cho từng sản phẩm
                ]);
            }
        }
    
        // Kiểm tra phương thức thanh toán
        if ($paymentMethod === 'vnpay') {
            return response()->json([
                'message' => 'Đặt hàng thành công! Chuyển hướng đến thanh toán.',
                'paymentUrl' => route('vnpay_payment') // Trả về URL để chuyển hướng thanh toán
            ]);
        }
    
        // Trả về thông tin đơn hàng đã tạo nếu không phải vnpay
        return response()->json([
            'message' => 'Đặt hàng thành công!',
            'orders' => $orders,
            'totalPayment' => number_format($totalPayment, 0, ',', '.'),
        ]);
    }
    

    
    
    
    












    
}
