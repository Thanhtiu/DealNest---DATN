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

        // Lấy các đơn hàng mà có ít nhất một OrderItem của seller có status là 'pending'
        $orderPending = Order::whereHas('orderItems', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId)
                ->where('status', 'pending'); // Kiểm tra ít nhất một item có status là 'pending'
        })
            ->with([
                'orderItems' => function ($query) use ($sellerId) {
                    $query->where('seller_id', $sellerId);
                },
                'user'
            ])->get();

        $orderWaitingDelivery = Order::whereHas('orderItems', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId)
                ->where('status', 'waiting_for_delivery');
        })
            ->with([
                'orderItems' => function ($query) use ($sellerId) {
                    $query->where('seller_id', $sellerId);
                },
                'user'
            ])->get();

        $orderCancel = Order::whereHas('orderItems', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId)
                ->where('status', 'cancel');
        })
            ->with([
                'orderItems' => function ($query) use ($sellerId) {
                    $query->where('seller_id', $sellerId);
                },
                'user'
            ])->get();
        return view('sellers.order.index', compact('orderPending', 'orderWaitingDelivery'));
    }



    public function detail($id, $status = null)
    {
        $sellerId = Session::get('sellerId');

        // Lấy order với các điều kiện và kiểm tra trạng thái nếu có truyền vào
        $orderDetail = Order::with([
            'orderItems' => function ($query) use ($sellerId, $status) {
                $query->where('seller_id', $sellerId);
                // Nếu có truyền vào status, thì thêm điều kiện lọc theo status
                if ($status) {
                    $query->where('status', $status);
                }
            },
            'orderItems.product',
            'user'
        ])->find($id);

        // Kiểm tra nếu không có order hoặc order không có orderItems nào phù hợp
        if (!$orderDetail || $orderDetail->orderItems->isEmpty()) {
            return redirect()->route('seller.order')->with('error', 'Đơn hàng không tồn tại hoặc không có quyền truy cập.');
        }

        return view('sellers.order.detail', [
            'orderDetail' => $orderDetail,
            'orderItems' => $orderDetail->orderItems,
            'status' => $status // Truyền thêm status vào view
        ]);
    }



    public function confirm(Request $request, $id)
    {
        $items = $request->input('items');

        if ($items) {
            foreach ($items as $itemData) {
                $orderItem = OrderItem::find($itemData['id']);
                if ($orderItem) {
                    // Xác định trạng thái và lý do hủy
                    $status = $itemData['status'];
                    $cancellationReason = null;

                    // Sử dụng switch để kiểm tra các lý do và cập nhật trạng thái
                    switch ($status) {
                        case 'out_of_stock':
                            $orderItem->status = 'return';
                            $cancellationReason = 'Hết hàng';
                            break;
                        case 'invalid_info':
                            $orderItem->status = 'return';
                            $cancellationReason = 'Thông tin không hợp lệ';
                            break;
                        case 'unknown_reason':
                            $orderItem->status = 'return';
                            $cancellationReason = 'Không rõ lý do liên hệ shop';
                            break;
                        default:
                            $orderItem->status = $status;
                            break;
                    }

                    // Nếu có lý do hủy, cập nhật cột cancellation_reason
                    if ($cancellationReason !== null) {
                        $orderItem->cancellation_reason = $cancellationReason;
                    }

                    $orderItem->save();
                }
            }
        }

        // Kiểm tra nếu còn item nào có trạng thái 'pending' hoặc 'waiting_for_delivery' trong order đó
        $remainingItems = OrderItem::where('order_id', $id)
            ->whereIn('status', ['pending'])
            ->exists();

        // Nếu còn item, chuyển về trang chi tiết đơn hàng, nếu không, chuyển về danh sách đơn hàng
        if ($remainingItems) {
            return redirect()->route('seller.order.detail', ['id' => $id])
                ->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
        } else {
            return redirect()->route('seller.order') // Thay 'seller.order.index' thành 'seller.order'
                ->with('success', 'Tất cả các mục trong đơn hàng đã được xử lý.');
        }
    }
}
