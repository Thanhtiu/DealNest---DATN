<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Google\Protobuf\Internal\Message;
use Illuminate\Support\Facades\Validator;

class OrderSellerController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        // Lấy các đơn hàng có trạng thái 'pending' và kiểm tra điều kiện payment_method và payment_status
        $orderPending = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['pending', 'partial'])
            ->whereHas('orderItems', function ($query) {
                $query->where('status', 'pending');
            })
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        // Lấy các đơn hàng có trạng thái 'waiting_for_delivery' và kiểm tra điều kiện payment_method và payment_status
        $orderWaitingDelivery = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['waiting_for_delivery', 'partial'])
            ->whereHas('orderItems', function ($query) {
                $query->whereIn('status', ['waiting_for_delivery']);
            })
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        // Lấy các đơn hàng có trạng thái 'cancel' và kiểm tra điều kiện payment_method và payment_status
        $orderCancel = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['cancelled', 'partial'])
            ->whereHas('orderItems', function ($query) {
                $query->whereIn('status', ['cancel']);
            })
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        $orderBuyerCancel = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['cancelled', 'partial'])
            ->whereHas('orderItems', function ($query) {
                $query->whereIn('status', ['buyer_cancel']);
            })
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        $orderSuccess = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['cancelled', 'partial'])
            ->whereHas('orderItems', function ($query) {
                $query->whereIn('status', ['success']);
            })
            ->where(function ($query) {
                $query->where('payment_method', 'cod')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', '!=', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->with(['orderItems.product', 'user'])
            ->get();

        return view('sellers.order.index', compact('orderSuccess', 'orderBuyerCancel', 'orderPending', 'orderWaitingDelivery', 'orderCancel'));
    }



    public function detail($id, $status = null)
    {
        $sellerId = Session::get('sellerId');

        // Lấy order và các OrderItem liên quan dựa trên điều kiện seller_id và status nếu có
        $orderDetail = Order::with([
            'orderItems' => function ($query) use ($id, $sellerId, $status) {
                $query->where('order_id', $id)
                    ->where('seller_id', $sellerId);
                // Nếu có truyền vào status, thì thêm điều kiện lọc theo status
                if ($status) {
                    $query->where('status', $status);
                }
            },
            'orderItems.product',
            'user'
        ])->where('id', $id)
            ->where('seller_id', $sellerId)
            ->first();

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
        $sellerId = Session::get('sellerId');

        if ($items) {
            foreach ($items as $itemData) {
                $orderItem = OrderItem::find($itemData['id']);
                if ($orderItem) {
                    // Thực hiện validate trước khi xử lý logic cập nhật trạng thái

                    // Sau khi validate thành công, xử lý cập nhật trạng thái
                    switch ($itemData['status']) {
                        case 'waiting_for_delivery':
                            if ($itemData['status'] === 'waiting_for_delivery') {
                                // Tạo validator cho từng item cụ thể
                                $validator = Validator::make([
                                    'delivery_date' => $request->input("items.{$itemData['id']}.delivery_date")
                                ], [
                                    'delivery_date' => 'required|date|after_or_equal:today'
                                ], [
                                    'delivery_date.required' => 'Vui lòng chọn ngày giao nhận.',
                                    'delivery_date.after_or_equal' => 'Ngày giao nhận phải từ hôm nay trở đi.'
                                ]);

                                // Kiểm tra nếu có lỗi
                                if ($validator->fails()) {
                                    return redirect()->route('seller.order.detail', ['id' => $id, 'status' => 'pending'])
                                        ->withErrors($validator)
                                        ->withInput();
                                }

                                // Cập nhật trạng thái và ngày giao nhận nếu đã được duyệt
                                $orderItem->status = 'waiting_for_delivery';

                                // Cập nhật ngày giao nhận nếu có trong request
                                if ($request->has("items.{$itemData['id']}.delivery_date")) {
                                    $deliveryDate = $request->input("items.{$itemData['id']}.delivery_date");
                                    $orderItem->delivery_date = Carbon::parse($deliveryDate);
                                }
                            }
                            break;

                        case 'out_of_stock':
                            $orderItem->status = 'cancel';
                            $orderItem->cancellation_reason = 'Hết hàng';
                            break;

                        case 'invalid_info':
                            $orderItem->status = 'cancel';
                            $orderItem->cancellation_reason = 'Thông tin không hợp lệ';
                            break;

                        case 'unknown_reason':
                            $orderItem->status = 'cancel';
                            $orderItem->cancellation_reason = 'Không rõ lý do liên hệ shop';
                            break;

                        default:
                            $orderItem->status = $itemData['status'];
                            break;
                    }

                    // Lưu thay đổi vào cơ sở dữ liệu
                    $orderItem->save();
                }
            }
        }
        // Đếm số lượng sản phẩm dựa trên trạng thái
        $totalItems = OrderItem::where('order_id', $id)
            ->where('seller_id', $sellerId)
            ->count();

        $approvedItems = OrderItem::where('order_id', $id)
            ->where('seller_id', $sellerId)
            ->where('status', 'waiting_for_delivery')
            ->count();

        $cancelledItems = OrderItem::where('order_id', $id)
            ->where('seller_id', $sellerId)
            ->where('status', 'cancel')
            ->count();

        $pendingItems = OrderItem::where('order_id', $id)
            ->where('seller_id', $sellerId)
            ->where('status', 'pending')
            ->count();

        // Cập nhật trạng thái của đơn hàng dựa trên tình trạng của các sản phẩm
        $order = Order::find($id);

        if ($approvedItems === $totalItems) {
            // Tất cả sản phẩm đều được duyệt
            $order->delivery_date = Carbon::now(); // Thêm thời gian hiện tại vào cột delivery_date
        } elseif ($cancelledItems === $totalItems) {
            // Tất cả sản phẩm đều bị từ chối
            $order->status = 'cancelled';
        } elseif (($approvedItems > 0 && $cancelledItems > 0) ||
            ($cancelledItems > 0 && $pendingItems > 0) ||
            ($approvedItems > 0 && $pendingItems > 0)
        ) {
            // Trường hợp có sản phẩm duyệt và có từ chối, hoặc từ chối và chưa cập nhật, hoặc duyệt và chưa cập nhật
            $order->status = 'partial';
        } elseif ($pendingItems === $totalItems) {
            // Nếu tất cả sản phẩm đều chưa được duyệt
            $order->status = 'pending';
        }

        $order->save();

        // Chuyển hướng dựa trên các điều kiện
        if ($order->status === 'pending') {
            return redirect()->route('seller.order.detail', ['id' => $id, 'status' => 'pending'])
                ->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
        } else {
            return redirect()->route('seller.order')
                ->with('success', 'Tất cả các mục trong đơn hàng đã được xử lý.');
        }
    }
}
