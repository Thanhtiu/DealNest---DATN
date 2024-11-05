<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId');
        $seller = Seller::where('user_id', $userId)->first();

        if (!$seller) {
            return redirect()->route('seller.register.index');
        } else {
            if ($seller->status == 0) {
                session()->flash('alertMessage', "Cửa hàng của bạn đang tạm khóa vì lý do " . $seller->note . ". Liên hệ dịch vụ chăm sóc khách hàng để được giải quyết!");
                session()->flash('alertType', 'error');
                return redirect('/');
            }

            $sellerId = $seller->id;
            Session::put('sellerId', $sellerId);

            // Thống kê tổng doanh thu theo tháng
            $monthlyRevenue = OrderItem::whereHas('order', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId)
                    ->whereIn('status', ['waiting_for_delivery', 'completed']);
            })
                ->selectRaw('MONTH(orders.delivery_date) as month, SUM(order_items.total) as total_revenue')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->groupBy('month')
                ->orderBy('month')
                ->get();


            $revenueData = array_fill(1, 12, 0);
            foreach ($monthlyRevenue as $revenue) {
                $revenueData[$revenue->month] = $revenue->total_revenue;
            }

            // Thống kê tổng số lượng user_id theo tháng
            $monthlyUsers = Order::where('seller_id', $sellerId)
                ->selectRaw('MONTH(delivery_date) as month, COUNT(DISTINCT user_id) as total_users')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $userData = array_fill(1, 12, 0);
            foreach ($monthlyUsers as $user) {
                $userData[$user->month] = $user->total_users;
            }

            // Thống kê số người mua hàng nhiều nhất từ seller
            $topUsers = OrderItem::whereHas('order', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId)
                    ->whereIn('status', ['waiting_for_delivery', 'completed']);
            })
                ->with('order.user')
                ->get()
                ->groupBy('order.user.id')
                ->map(function ($orderItems, $userId) {
                    return [
                        'user' => $orderItems->first()->order->user,
                        'total_items' => $orderItems->sum('quantity')
                    ];
                })
                ->sortByDesc('total_items')
                ->take(100);

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
                ->count();


            // Số lượng đơn hàng đang chờ giao (waiting_for_delivery)
            $waitingForDelivery = Order::where('seller_id', $sellerId)
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
                ->count();

            // Số lượng đơn hàng bị hủy bởi người mua 
            $cancelled = Order::where('seller_id', $sellerId)
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
                ->count();

            // Số lượng đơn hàng đã hoàn thành (completed)
            $completed = Order::where('seller_id', $sellerId)
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
                ->get()
                ->count();
          
            // Số lượng đơn hàng từ chối
            $refuse = Order::where('seller_id', $sellerId)
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
                ->count();



            return view('sellers.index', compact(
                'cancelled',
                'pending',
                'waitingForDelivery',
                'completed',
                'refuse',
                'revenueData',
                'userData',
                'topUsers'
            ));
        }
    }
}
