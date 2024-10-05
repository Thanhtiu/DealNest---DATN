<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Address;

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
}
