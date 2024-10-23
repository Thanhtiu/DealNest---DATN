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
  
    public function showCategory($id, Request $request)
    {
        $sub = $request->sub;   
        $sort = $request->sortby;
    
        // Lấy category cha theo id
        $parentCategory = Category::findOrFail($id);
        $parentCategoryName = $parentCategory->name;
    
        // Lấy các subcategories có parent_id là $id
        $subcategories = Category::where('parent_id', $id)->get();
    
        // Khởi tạo truy vấn sản phẩm
        $query = Product::query();
    
        // Kiểm tra nếu $sub không rỗng
        if ($sub != "") {
            // Lấy sản phẩm có category_id bằng $sub_id
            $query->where('category_id', $sub);
        } else {
            // Lấy sản phẩm của category hiện tại và các subcategories
            $query->where('category_id', $id)
                  ->orWhereIn('category_id', $subcategories->pluck('id'));
        }
    
        // Kiểm tra nếu sortBy không rỗng và thực hiện sắp xếp
        if (!empty($sort)) {
            switch ($sort) {
                case 'DESC':
                    $query->orderBy('id', 'desc'); // Sắp xếp theo ngày tạo
                    break;
                case 'ASC':
                    $query->orderBy('id', 'asc');
                    break;
                case 'sale':
                    $query->orderBy('sales', 'desc'); // Sắp xếp theo doanh số
                    break;
                case 'price-asc':
                    $query->orderBy('price', 'asc'); // Sắp xếp theo giá từ thấp đến cao
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc'); // Sắp xếp theo giá từ cao đến thấp
                    break;
            }
        }
    
        // Thực hiện truy vấn và lấy sản phẩm
        $products = $query->get();
    
        // Trả về view với dữ liệu
        return view('client.category', compact('parentCategory', 'subcategories', 'products', 'parentCategoryName'));
    }
    
    
    

    

    
}
