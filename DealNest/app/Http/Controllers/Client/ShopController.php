<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use Carbon\Carbon;
class ShopController extends Controller
{
    public function index($id)
    {    
        $shop = Seller::find($id);
        $products = Product::where('seller_id', $id)->get();
        $shopJoinDate = $shop->created_at;
        $currentDate = Carbon::now();
        $join = round($shopJoinDate->diffIndays($currentDate));
        return view('client.shop',compact('shop','products','join'));
    }
}
