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
        $paymentMethod = $request->input('paymentMethod') ?: 'cod';
    
        // Truy vấn dữ liệu của các CartItem
        $cartItems = Cart_item::with('product')
            ->whereIn('id', $cartItemIds)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'], 404);
        }
    
        // Nhóm các sản phẩm theo seller_id
        $groupedItems = $cartItems->groupBy(fn($item) => $item->product->seller_id);
    
        $orders = [];
        $orderIds = []; // Khởi tạo mảng để lưu tất cả orderId
        $productIds = []; // Khởi tạo mảng để lưu tất cả productId
        $totalOrders = $groupedItems->count();
        $shippingFee = 15000;
    
        foreach ($groupedItems as $sellerId => $items) {
            // Tính tổng tiền cho đơn hàng
            $orderTotal = $items->sum(fn($item) => $item->total_price * $item->quantity);
    
            // Tính phí ship và tổng cộng với phí ship
            $orderShippingFee = $shippingFee / $totalOrders;
            $totalWithShipping = $orderTotal + $orderShippingFee;
    
            // Tạo đơn hàng với seller_id
            $order = Order::create([
                'user_id' => auth()->id(),
                'seller_id' => $sellerId, // Lưu seller_id
                'status' => 'pending',
                'total' => $totalWithShipping,
                'delivery_date' => now()->addDays(7),
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
            ]);
    
            $orders[] = $order;
            $orderIds[] = $order->id; // Lưu orderId vào mảng
    
            // Tạo order items cho từng sản phẩm
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'size' => $item->size,
                    'color' => $item->color,
                    'quantity' => $item->quantity,
                    'total' => $item->total_price * $item->quantity,
                ]);
    
                $productIds[] = $item->product_id; // Lưu productId vào mảng
            }
        }
    
        // Lưu mảng orderIds, productIds và tổng tiền vào session
        session(['orderIds' => $orderIds, 'productIds' => $productIds, 'totalWithShipping' => $totalPayment]);
    
        // Kiểm tra phương thức thanh toán
        if ($paymentMethod === 'vnpay') {
            return response()->json([
                'message' => 'Đặt hàng thành công! Chuyển hướng đến thanh toán.',
                'paymentUrl' => route('vnpay_payment')
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
