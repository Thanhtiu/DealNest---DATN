<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Seller;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('userId'); 
        $seller = Seller::where('user_id', $userId)->first(); 
    
        if (!$seller) {
            return redirect()->route('seller.register.index');
        } else {
            $sellerId = $seller->id;
            Session::put('sellerId', $sellerId);
            return view('sellers.index'); 
        }
    }
    
}