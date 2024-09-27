<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request,$category_slug, $subcategory_slug = ""){

        $column = "id";

        $sort = "DESC";

        $sortby = $request->get('sortby');

        switch($sortby){
            case 'ASC':
                $sort = "ASC";
                break;
            case 'sale':
                $column = 'sales';
                $sort = 'DESC';
                break;
            case 'price-asc':
                $column = 'price';
                $sort = 'ASC';
                break;
            case 'price-desc':
                $column = 'price';
                $sort = 'DESC';
                break;
            default:
                break;
        }

        // dd($sort);

        $category = Category::where('slug',$category_slug)->where('status',1)->first();

        $listSubCategory = SubCategory::where('category_id',$category->id)->get();

        $productCategory = Product::with('product_image')
        ->where('category_id', $category->id)
        ->where('status','Đã phê duyệt')
        ->orderBy($column,$sort)
        ->get();
        if(is_null($category)){

            return "404";
        }

        // dd($productCategory);

        if($subcategory_slug != ""){

            $subCategory = SubCategory::where('slug',$subcategory_slug)->first();

            if(!is_null($subCategory)){

                $productCategory = Product::with('product_image')
                ->where('status','Đã phê duyệt')            
                ->where('subcategory_id', $subCategory->id)
                ->orderBy($column,$sort)
                ->get();

            }
      
        } 

        return view('client.category',
        compact('category','listSubCategory','productCategory','subcategory_slug'));
    }

    public function getProductAddress(Request $request){

        $data = $request->all();

        
        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $data
        ]);

    }


    
}
