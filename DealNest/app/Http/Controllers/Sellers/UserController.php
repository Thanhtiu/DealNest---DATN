<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Follower;
use App\Models\OrderItem;
use App\Models\Order;

class UserController extends Controller
{
    public function follower()
    {
        $sellerId = Session::get('sellerId');
        $followers = Follower::where('seller_id', $sellerId)->with('user')->get();

        // Lặp qua từng follower và tính số lượng đã mua hàng của từng user
        foreach ($followers as $follower) {
            $totalPurchasedQuantity = OrderItem::whereHas('order', function ($query) use ($follower, $sellerId) {
                $query->where('user_id', $follower->user_id)->where('seller_id', $sellerId);
            })->sum('quantity');

            $follower->total_purchased_quantity = $totalPurchasedQuantity;
        }

        return view('sellers.user.follower', compact('followers'));
    }

    public function order()
    {
        $sellerId = Session::get('sellerId');
        $userOrders = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['waiting_for_delivery', 'completed'])
            ->select('user_id')
            ->distinct()
            ->with('user')
            ->get();



        // Lặp qua từng follower và tính số lượng đã mua hàng của từng user
        foreach ($userOrders as $item) {
            $totalPurchasedQuantity = OrderItem::whereHas('order', function ($query) use ($item, $sellerId) {
                $query->where('user_id', $item->user_id)->where('seller_id', $sellerId);
            })->sum('quantity');

            $item->total_purchased_quantity = $totalPurchasedQuantity;
        }


        return view('sellers.user.order', compact('userOrders'));
    }

    public function deleteUserOrder($id)
    {
        $deleteUserOrder = Order::where('user_id', $id)->delete();
        return redirect()->route('seller.user.order')->with('success', 'Đã xóa người mua hàng cũng như đã xóa đơn hàng');
    }

    public function deleteUserFollower($id)
    {   
        $deleteFollower = Follower::where('user_id', $id)->delete();
        return redirect()->route('seller.user.follower')->with('success', 'Đã xóa người theo dõi');
    }
}
