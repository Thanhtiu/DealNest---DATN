<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Kiểm tra xem có giá trị total_amount và selected_items trong session không
        if (!session()->has('total_amount') || !session()->has('selected_items')) {
            // Nếu không có, chuyển hướng về route client.cart
            return redirect()->route('client.cart');
        }

        // Lấy dữ liệu từ session
        $totalAmount = session('total_amount');
        $selectedItems = session('selected_items'); // Đây là mảng đa chiều chứa product_id, product_name, quantity, và total_price



        // Trích xuất danh sách product_id từ selectedItems
        $productIds = array_column($selectedItems, 'product_id');

        // Truy vấn bảng products để lấy thông tin sản phẩm theo product_id
        $products = Product::whereIn('id', $productIds)->get();

        // Trả về view checkout và truyền dữ liệu
        return view('client.checkout', compact('totalAmount', 'selectedItems', 'products'));
    }


}
