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
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
    
        $products = Product::with('product_image')->orderBy('sales', 'desc')->paginate(12);
    
        return view('index', compact('products', 'categories'));
    }

 

   
    public function voucher(){
        return view('client.voucher');
    }

   
    public function shop(){
        return view('client.shop');
    }


}
