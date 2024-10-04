<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Voucher;

class PaymentController extends Controller
{
    public function index()
    {
        // Kiểm tra xem có giá trị total_amount và selected_items trong session không
        if (!session()->has('total_amount') || !session()->has('selected_items')) {
            return redirect()->route('client.cart');
        }
    
        // Lấy dữ liệu từ session
        $totalAmount = session('total_amount');
        $selectedItems = session('selected_items'); // Đây là mảng đa chiều chứa product_id, product_name, quantity, và total_price
    
        // Trích xuất danh sách product_id từ selectedItems
        $productIds = array_column($selectedItems, 'product_id');
    
        // Truy vấn bảng products để lấy thông tin sản phẩm theo product_id
        $products = Product::whereIn('id', $productIds)->get();
    
        // Lấy danh sách subcategory_id từ các sản phẩm đã chọn
        $subcategoryIds = $products->pluck('subcategory_id')->toArray();
    
        // Truy vấn danh sách các voucher có cùng subcategory_id với sản phẩm
        $vouchers = Voucher::whereIn('subcategory_id', $subcategoryIds)->get();
        // return $vouchers;
    
        // Trả về view checkout và truyền dữ liệu
        return view('client.checkout', compact('totalAmount', 'selectedItems', 'products', 'vouchers'));
    }
}
