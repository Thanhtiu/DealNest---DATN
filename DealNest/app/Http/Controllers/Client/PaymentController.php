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
            $shippingFee = $request->input('shipping_fee'); // Lấy phí vận chuyển từ request
    
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
    
            // Nhóm các sản phẩm theo seller_id
            $productsBySeller = collect($products)->groupBy(function ($product) {
                $productModel = Product::find($product['product_id']);
                return $productModel ? $productModel->seller_id : null;
            });
    
            // Kiểm tra xem có sản phẩm không tìm được seller_id không
            if ($productsBySeller->has(null)) {
                return response()->json(['message' => 'Một số sản phẩm không hợp lệ.'], 400);
            }
    
            // Tạo một mảng để lưu các order_id
            $orderIds = [];
    
            // Duyệt qua từng nhóm sản phẩm theo seller_id
            foreach ($productsBySeller as $sellerId => $productsGroup) {
                // Tính tổng giá trị cho từng nhóm sản phẩm của seller
                $groupTotalAmount = collect($productsGroup)->sum('total_price');
    
                // Lưu thông tin đơn hàng vào cơ sở dữ liệu cho mỗi seller
                $order = Order::create([
                    'user_id' => $userId,
                    'total' => $groupTotalAmount,
                    'delivery_date' => $deliveryDate,
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'pending',
                    'status' => 'pending',
                    'seller_id' => $sellerId, // Lưu seller_id vào đơn hàng
                ]);
    
                // Lưu order_id vào mảng
                $orderIds[] = $order->id;
    
                // Lưu sản phẩm vào bảng order_items
                foreach ($productsGroup as $product) {
                    // Lấy product_id từ dữ liệu sản phẩm
                    $productModel = Product::find($product['product_id']);
    
                    if ($productModel) {
                        // Tạo chuỗi thuộc tính từ mảng attributes
                        $attributes = [];
                        foreach ($product['attributes'] as $attribute) {
                            $attributes[] = $attribute['name'] . ': ' . $attribute['value'];
                        }
                        $attributesString = implode(', ', $attributes); // Tạo chuỗi cách nhau bằng dấu phẩy
    
                        // Lưu sản phẩm vào order_items
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $product['product_id'],
                            'quantity' => $product['quantity'],
                            'price' => $product['total_price'],
                            'seller_id' => $productModel->seller_id,
                            'name' => $request->input('user_name'),
                            'phone' => $request->input('user_phone'),
                            'address' => $request->input('user_address'),
                            'attribute' => $attributesString,
                        ]);
                    }
                }
            }
    
            // Lưu id của đơn hàng và phí vận chuyển vào session
            session(['order_ids' => $orderIds, 'shipping_fee' => $shippingFee]);
    
            // Trả về phản hồi với URL chuyển hướng
            return response()->json([
                'message' => 'Đơn hàng đã được tạo thành công!',
                'redirect_url' => route('vnpay_payment'),
            ]);
    
        } catch (\Exception $e) {
            // Ghi lỗi vào log và trả về thông báo lỗi
            \Log::error('Lỗi trong checkoutProcessing: ' . $e->getMessage());
            return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    
   
    
    
    
    
    
    
    

    
    
}
