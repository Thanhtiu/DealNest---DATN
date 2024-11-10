<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;


class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();

        $products = Product::with('product_image')->orderBy('sales', 'desc')->paginate(12);

        $banners = Banner::where('status', 1)->orderBy('created_at', 'desc')->get();
        
        $subCategories = Category::where('parent_id', '!=', 0)->get();

        return view('index', compact('products', 'categories', 'banners','subCategories'));
    }




    public function voucher()
    {
        return view('client.voucher');
    }


    public function shop()
    {
        return view('client.shop');
    }
}
