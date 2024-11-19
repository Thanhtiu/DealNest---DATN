<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Đơn hàng đang chờ xác nhận
        $all = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->whereIn('payment_status', ['pending', 'paid']);
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();
        // Đơn hàng đang chờ xác nhận
        $pending = Order::where('user_id', $userId)
            ->where('status', 'pending')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'pending');
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();

        // Đơn hàng chờ giao hàng
        $waitingForDelivery = Order::where('user_id', $userId)
            ->where('status', 'waiting_for_delivery')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'pending');
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();


        // Đơn hàng đã hoàn thành
        $completed = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();

        // Đơn hàng đã từ chối
        $refuse = Order::where('user_id', $userId)
            ->where('status', 'refuse')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'pending');
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();
        // Đơn hàng đã hủy
        $cancelled = Order::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'pending');
                    });
            })
            ->with('seller')
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();
        return view('client.order', compact('all', 'pending', 'waitingForDelivery', 'completed', 'refuse', 'cancelled'));
    }








    public function updateOrderItemStatus(Request $request)
    {
        $order = Order::find($request->order_item_id);


        if ($order) {
            $order->status = $request->status;
            if ($request->status === 'completed') {
                $orderItem = OrderItem::where('order_id', $order->id)->get();
                $order->payment_status = 'paid';
                foreach ($orderItem as $item) {
                    $product = Product::find($item->product_id);
                    $product->decrement('quantity', $item->quantity);
                    if ($product) {
                        $product->increment('sales', $item->quantity);
                        $product->save();
                    }
                }
            }
            $order->save();
            return response()->json([
                'success' => true,
                'message' => 'Trạng thái đơn hàng đã được cập nhật.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy mục đơn hàng.'
            ]);
        }
    }
}
