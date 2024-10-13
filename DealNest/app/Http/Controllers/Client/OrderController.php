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
        $orderAll = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        $orderPending = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['pendingOrderItems.product', 'user'])
            ->get();

        $orderWaitingForDelivery = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['waitingForDeliveryOrderItems.product', 'user'])
            ->get();

        $orderCancel = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['cancelOrderItems.product', 'user'])
            ->get();

        $orderBuyerCancel = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['buyerCancelOrderItems.product', 'user'])
            ->get();

        $orderSuccess = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['successOrderItems.product', 'user'])
            ->get();
        return view('client.order', compact('orderSuccess','orderCancel', 'orderAll', 'orderPending', 'orderWaitingForDelivery', 'orderBuyerCancel'));
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
