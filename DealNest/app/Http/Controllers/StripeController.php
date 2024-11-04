<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
class StripeController extends Controller
{
    public function session(Request $request)
    {
        $totalWithShipping = session('totalWithShipping');

        $productIds = session('productIds');

        // Kiểm tra nếu $productIds là một mảng và có ít nhất một phần tử
        if (is_array($productIds) && count($productIds) > 0) {
            // Lấy một productName bất kỳ từ danh sách productIds
            $productName = Product::whereIn('id', $productIds)->pluck('name')->first();

        } else {
            // Xử lý trường hợp $productIds không hợp lệ hoặc rỗng
            dd('Không tìm thấy sản phẩm');
        }
        Stripe::setApiKey(config('stripe.sk'));
    
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'vnd',
                        'product_data' => [
                            "name" => $productName,
                        ],
                        'unit_amount'  => $totalWithShipping, // Sử dụng trực tiếp giá trị nhập vào
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('checkout'),
        ]);
    
        return redirect()->away($session->url);
    }

    public function success(){
        return "Thanh toán thành công";
    }

}
