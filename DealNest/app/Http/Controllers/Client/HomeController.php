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
        // Lấy tất cả danh mục cha (parent_id = 0)
        $categories = Category::where('parent_id', 0)->get();
    
        // Lấy danh sách sản phẩm với hình ảnh, sắp xếp theo số lượng bán hàng
        $products = Product::with('product_image')->orderBy('sales', 'desc')->paginate(6);
    
        // Trả về view với danh mục và sản phẩm
        return view('index', compact('products', 'categories'));
    }

 

   
    public function voucher(){
        return view('client.voucher');
    }

   
    public function shop(){
        return view('client.shop');
    }


}
