<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;


class CategoryAndSubcategoryController extends Controller
{
    public function index()
    {
        // Lấy sellerId từ session
        $sellerId = Session::get('sellerId');

        if ($sellerId) {
            // Lấy tất cả sản phẩm cùng với category và subcategory
            $products = Product::with('category', 'subcategory')
                ->where('seller_id', $sellerId)
                ->get();

            $categories = $products->pluck('category')->unique('id')->values();
            $subCategories = $products->pluck('subcategory')->unique('id')->values();
            $countCategories = $categories->count();
            $countSubCategories = $subCategories->count();
            return view('sellers.category.index', compact('products', 'categories', 'subCategories', 'countCategories', 'countSubCategories'));
        }
    }
}
