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


class ProductDetailController extends Controller
{
    public function index($id){
        $product = Product::with(['subcategory','product_image'])->find($id);
        return view('client.product-detail');
    }
}
