<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Brand;

class ProdcutStatisticsController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        // Lấy tất cả các cột từ bảng products
        $bestSeller = Product::where('seller_id', $sellerId)
            ->orderBy('sales', 'desc')
            ->take(3)
            ->get();

        $countSales = $bestSeller->sum('sales');


        return view('sellers.productStatistics.index', compact('bestSeller', 'countSales'));
    }

    public function detail($id)
    {
        $category = Category::all();
        $brand = Brand::all();
        $attribute = Attribute::all();
        $product = Product::with('attribute_values.attribute')->find($id);

        return view('sellers.productStatistics.detail', compact('category', 'brand', 'product', 'attribute'));
    }
}
