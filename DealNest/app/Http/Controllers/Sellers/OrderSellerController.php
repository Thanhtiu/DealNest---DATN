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
use Nette\Utils\Random;

class OrderSellerController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        $all = Order::where('seller_id', $sellerId)
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
            ->withCount('orderItems')
            ->get();
        $pending = Order::where('seller_id', $sellerId)
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
            ->withCount('orderItems')
            ->get();

        $completed = Order::where('seller_id', $sellerId)
            ->where('status', 'completed')
            ->where(function ($query) {
                $query->where('payment_method', 'vnpay')
                    ->where('payment_status', 'paid')
                    ->orWhere(function ($query) {
                        $query->where('payment_method', 'cod')
                            ->where('payment_status', 'paid');
                    });
            })
            ->withCount('orderItems')
            ->get();

        $cancelled = Order::where('seller_id', $sellerId)
            ->where('status', 'cancelled')
            ->where('payment_method', 'cod')
            ->whereIn('payment_status', ['pending', 'paid'])
            ->withCount('orderItems')
            ->get();

        $waitingForDelivery = Order::where('seller_id', $sellerId)
            ->where('status', 'waiting_for_delivery')
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
            ->withCount('orderItems')
            ->get();

        $refused = Order::where('seller_id', $sellerId)
            ->where('status', 'refuse')
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
            ->withCount('orderItems')
            ->get();
        return view('sellers.order.index', compact('all', 'pending', 'completed', 'cancelled', 'waitingForDelivery', 'refused'));
    }



    public function generateOrderCode($id)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $id . $randomString;
    }

    public function detail($id, $status = null)
    {
        $sellerId = Session::get('sellerId');
        $orderDetail = OrderItem::where('order_id', $id)->with('product', 'user')->get();
        $orderCode = $this->generateOrderCode($id);
        $order = Order::where('seller_id', $sellerId)->where('id', $id)->with('user')->first();
        return view('sellers.order.detail', [
            'order' => $order,
            'orderDetail' => $orderDetail,
            'orderCode' => $orderCode,
        ]);
    }




    public function confirm(Request $request, $id)
    {
        $sellerId = Session::get('sellerId');

        // Kiểm tra xem đơn hàng có thuộc về seller hiện tại không
        $order = Order::where('id', $id)->where('seller_id', $sellerId)->first();
        if (!$order) {
            return redirect()->back()->withErrors('Không tìm thấy đơn hàng hoặc bạn không có quyền cập nhật.');
        }

        $order->status = $request->input('status');
        $order->cancellation_reason = $request->input('cancellation_reason');
        $order->delivery_date = $request->input('delivery_date');
        if ($request->status === 'waiting_for_delivery' || $request->status === 'pending' || $request->status === 'completed') {
            $order->cancellation_reason = null;
        }
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công!');
    }
}
