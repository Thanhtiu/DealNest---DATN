<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSellerController extends Controller
{
    public function index(){
        
        return view('sellers.order.index');
    }
}
