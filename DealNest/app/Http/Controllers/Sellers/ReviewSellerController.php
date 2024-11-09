<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Seller;
use App\Models\Review;

class ReviewSellerController extends Controller
{
    public function index(){
        $sellerId = Session::get('sellerId');
        $reviews = Review::where('seller_id', $sellerId);

        
        return $reviews;
    }
}
