<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
Use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product_image;
use App\Models\Attribute;


class HomeController extends Controller
{
    public function index(){
        $products = Product::with('product_image')->orderBy('sales','desc')->get();


        return view('index',compact('products'));
    }
    public function profile(){
        return view('client.profile');
    }
    public function adress(){
        return view('client.adress');
    }
    public function voucher(){
        return view('client.voucher');
    }
    public function productDetail(){
        return view('client.product-detail');
    }
    public function shop(){
        return view('client.shop');
    }
}
