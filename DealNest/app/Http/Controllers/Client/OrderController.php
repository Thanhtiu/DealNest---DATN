<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

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
            ->whereHas('orderItems')
            ->with('orderItems.product')
            ->get();

        return view('client.order', compact('pending', 'waitingForDelivery', 'completed', 'refuse', 'cancelled'));
    }








    public function updateOrderItemStatus(Request $request)
    {
        // Tìm OrderItem theo ID
        $orderItem = OrderItem::find($request->order_item_id);

        // Kiểm tra nếu OrderItem tồn tại
        if ($orderItem) {
            // Cập nhật trạng thái của OrderItem
            $orderItem->status = $request->status;
            $orderItem->save();

            // Trả về phản hồi thành công
            return response()->json([
                'success' => true,
                'message' => 'Trạng thái đơn hàng đã được cập nhật.'
            ]);
        } else {
            // Nếu không tìm thấy OrderItem, trả về lỗi
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy mục đơn hàng.'
            ]);
        }
    }
}
