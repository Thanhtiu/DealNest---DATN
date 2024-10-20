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
            $monthlyRevenue = OrderItem::where('seller_id', $sellerId)
                ->whereIn('status', ['waiting_for_delivery', 'success'])
                ->selectRaw('MONTH(delivery_date) as month, SUM(price * quantity) as total_revenue')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $revenueData = array_fill(1, 12, 0); // Tạo mảng 12 tháng với giá trị 0
            foreach ($monthlyRevenue as $revenue) {
                $revenueData[$revenue->month] = $revenue->total_revenue;
            }

            // Thống kê tổng số lượng user_id thuộc seller_id theo tháng
            // Thống kê tổng số lượng user_id thuộc seller_id theo tháng
            $monthlyUsers = Order::where('seller_id', $sellerId)
                ->selectRaw('MONTH(delivery_date) as month, COUNT(DISTINCT user_id) as total_users')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $userData = array_fill(1, 12, 0); // Tạo mảng 12 tháng với giá trị 0
            foreach ($monthlyUsers as $user) {
                $userData[$user->month] = $user->total_users;
            }

            // Thống kê số người mua hàng nhiều nhất từ seller
            $topUsers = OrderItem::with('order.user') // Sử dụng quan hệ để lấy thông tin người dùng
                ->where('seller_id', $sellerId)
                ->whereIn('status', ['waiting_for_delivery', 'success'])
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

            // return $topUsers;

            // Các thống kê khác
            $pending = OrderItem::where('seller_id', $sellerId)->where('status', 'pending')->count();
            $waitingForDelivery = OrderItem::where('seller_id', $sellerId)->where('status', 'waiting_for_delivery')->count();
            $buyerCancel = OrderItem::where('seller_id', $sellerId)->where('status', 'buyer_cancel')->count();
            $success = OrderItem::where('seller_id', $sellerId)->where('status', 'success')->count();
            $cancel = OrderItem::where('seller_id', $sellerId)->where('status', 'cancel')->count();
            return view('sellers.index', compact(
                'cancel',
                'pending',
                'waitingForDelivery',
                'buyerCancel',
                'success',
                'revenueData',
                'userData',
                'topUsers'
            ));
        }
    }
}
