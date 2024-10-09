<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $orderAll = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('payment_method', '!=', 'vnpay');
                    });
            })
            ->with('orderItems.product')
            ->get();

        $orderPending = Order::where('user_id', $userId)
            ->where('status', 'pending')
            ->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('payment_method', 'vnpay')
                        ->where('payment_status', 'paid');
                })
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('payment_method', '!=', 'vnpay');
                    });
            })
            ->whereHas('orderItems', function ($query) {
                $query->where('status', 'pending');
            })
            ->with(['orderItems' => function ($query) {
                $query->where('status', 'pending')->with('product');
            }])
            ->get();
        return view('client.order', compact('orderAll', 'orderPending'));
    }
}
