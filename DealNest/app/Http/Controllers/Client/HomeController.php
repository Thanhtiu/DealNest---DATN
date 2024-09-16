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

        $categories = Category::all();

        $category_1 = $categories->slice(0,ceil($categories->count()/2));
        
        $category_2 = $categories->slice(ceil($categories->count()/2));

        $products = Product::with('product_image')->orderBy('sales','desc')->get();
        // return dd($products);
        return view('index',compact('products','category_1','category_2'));
    }
   


   
    public function voucher(){
        return view('client.voucher');
    }

   
    public function shop(){
        return view('client.shop');
    }


}
