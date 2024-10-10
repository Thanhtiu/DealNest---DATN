<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;


class OrderSellerController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        $orders = Order::whereHas('orderItems', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
            ->with([
                'orderItems' => function ($query) use ($sellerId) {
                    $query->where('seller_id', $sellerId);
                },
                'user'
            ])->get();

        return view('sellers.order.index', compact('orders'));
    }

    public function detail($id)
    {
        $sellerId = Session::get('sellerId');

        $orderDetail = Order::with([
            'orderItems' => function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            },
            'orderItems.product',
            'user'
        ])->find($id);

        // Kiểm tra nếu không có order hoặc order không có orderItems nào phù hợp
        if (!$orderDetail || $orderDetail->orderItems->isEmpty()) {
            return redirect()->route('sellers.order.index')->with('error', 'Đơn hàng không tồn tại hoặc không có quyền truy cập.');
        }

        return view('sellers.order.detail', [
            'orderDetail' => $orderDetail,
            'orderItems' => $orderDetail->orderItems,
        ]);
    }
}
