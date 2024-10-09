<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $userId =  auth()->id();
        $userAddress = Address::where('user_id', $userId)->where('active', 1)->first();
        

        if (!session()->has('total_amount') || !session()->has('selected_items')) {
            return redirect()->route('client.cart');
        }

        $totalAmount = session('total_amount');
        $selectedItems = session('selected_items');
        $productIds = array_column($selectedItems, 'product_id');

        // Lấy thông tin các sản phẩm từ cơ sở dữ liệu
        $products = Product::whereIn('id', $productIds)->get();

        // Nhóm sản phẩm theo seller để hiển thị voucher theo từng người bán
        $groupedProducts = $products->groupBy('seller_id');

        // Khởi tạo mảng để chứa voucher của từng seller
        $sellerVouchers = [];

        // Lấy voucher theo seller và danh mục con
        foreach ($groupedProducts as $sellerId => $sellerProducts) {
            $subcategoryIds = $sellerProducts->pluck('subcategory_id')->toArray();

            // Lấy voucher cho mỗi seller
            $vouchers = Voucher::whereIn('subcategory_id', $subcategoryIds)
                ->where('seller_id', $sellerId)
                ->get();

            // Gán voucher vào mảng sellerVouchers
            $sellerVouchers[$sellerId] = $vouchers;
        }

        // Trả về view với dữ liệu
        return view('client.checkout', compact('totalAmount', 'selectedItems', 'groupedProducts', 'sellerVouchers', 'products','userAddress'));
    }




    public function checkoutProcessing(Request $request) {
        try {
            // Lấy dữ liệu từ request
            $totalAmount = $request->input('total_amount');
            $paymentMethod = $request->input('payment_method');
            $products = $request->input('products'); // Lấy danh sách sản phẩm từ request
    
            // Kiểm tra dữ liệu
            if (is_null($totalAmount) || is_null($paymentMethod) || empty($products)) {
                return response()->json(['message' => 'Dữ liệu không hợp lệ.'], 400);
            }
    
            // Xử lý giá trị totalAmount
            $totalAmount = intval(preg_replace('/[^\d]/', '', $totalAmount));
    
            // Kiểm tra phương thức thanh toán
            if ($paymentMethod === "VNPay") {
                $paymentMethod = "vnpay";
            } elseif ($paymentMethod === "Thanh toán khi nhận hàng") {
                $paymentMethod = "cod";
            }
    
            // Lấy user_id từ phiên làm việc hiện tại
            $userId = Auth::id();
            if (is_null($userId)) {
                return response()->json(['message' => 'User không xác định.'], 400);
            }
    
            // Tính toán delivery_date
            $deliveryDate = Carbon::now()->addDays(5);
    
            // Lưu thông tin đơn hàng vào cơ sở dữ liệu
            $order = Order::create([
                'user_id' => $userId,
                'total' => $totalAmount,
                'delivery_date' => $deliveryDate,
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);
    
       // Tạo một mảng để lưu các product_id và seller_id
$addedProductIds = [];
$sellerIds = [];

// Lưu sản phẩm vào bảng order_items
foreach ($products as $product) {
    // Lấy product_id từ dữ liệu sản phẩm
    $productModel = Product::find($product['product_id']); // Tìm sản phẩm dựa trên product_id

    if ($productModel) {
        // Kiểm tra xem sản phẩm có tồn tại không
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product['product_id'], // Lấy product_id từ dữ liệu sản phẩm
            'quantity' => $product['quantity'], // Lấy quantity từ dữ liệu sản phẩm
            'price' => $product['total_price'], // Lưu giá sản phẩm
            'seller_id' => $productModel->seller_id, // Lưu seller_id từ sản phẩm
        ]);

        // Thêm product_id vào mảng
        $addedProductIds[] = $product['product_id'];
        // Lấy seller_id và thêm vào mảng sellerIds
        $sellerIds[] = $productModel->seller_id;
    }
}

// Lưu id của đơn hàng và danh sách product_id vào session
session(['order_id' => $order->id]);
session(['added_product_ids' => $addedProductIds]);

            // Trả về phản hồi với URL chuyển hướng
            return response()->json([
                'message' => 'Đơn hàng đã được tạo thành công!',
                'redirect_url' => route('vnpay_payment'), // Trả về URL chuyển hướng
            ]);
    
        } catch (\Exception $e) {
            // Ghi lỗi vào log và trả về thông báo lỗi
            \Log::error('Lỗi trong checkoutProcessing: ' . $e->getMessage());
            return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
    
    
    
   
    
    
    
    
    
    
    

    
    
}
