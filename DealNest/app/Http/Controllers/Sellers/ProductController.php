<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index(){
        return view('sellers.products.list');
    }

    public function store(){
        // Lấy danh sách thể loại
        $category = Category::all();

        return view('sellers.products.manage', compact('category'));
    }

    public function getSubCategory(Request $request){
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subCategories);
    }
}
