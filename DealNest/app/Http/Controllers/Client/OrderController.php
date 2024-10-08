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
        $orderPending = Order::where('user_id', $userId)->where('status', 'pending')->get();
        return view('client.order',compact('orderPending'));
    }
}
