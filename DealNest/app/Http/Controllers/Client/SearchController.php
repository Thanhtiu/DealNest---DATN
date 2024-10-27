<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Lấy các danh mục cha có `parent_id` là 0
        $parentCategories = Category::where('parent_id', 0)->get();

        // Lấy các danh mục con có `parent_id` khác 0
        $subCategories = Category::where('parent_id', '!=', 0)->get();

        // Tìm kiếm sản phẩm theo tên được nhập từ form tìm kiếm
        $searchTerm = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
            ->with('category.parent') // lấy cả thông tin danh mục và danh mục cha của sản phẩm
            ->get();

        // Lấy danh sách thể loại con có cùng danh mục cha với sản phẩm đầu tiên (nếu có)
        $relatedSubCategories = collect();
        if ($products->isNotEmpty()) {
            // Lấy `parent_id` của danh mục cha từ sản phẩm đầu tiên tìm thấy
            $parentId = $products->first()->category->parent_id ?? null;

            if ($parentId) {
                // Lấy tất cả các danh mục con có cùng `parent_id`
                $relatedSubCategories = Category::where('parent_id', $parentId)->get();
            }
        }


        // Trả về view với các dữ liệu cần thiết
        return view('client.search', compact(
            'parentCategories',
            'subCategories',
            'products',
            'relatedSubCategories'
        ));
    }







    public function convertToLowerNoAccents($str)
    {
        // Chuyển chuỗi sang chữ thường
        $str = strtolower($str);

        // Thay thế các ký tự có dấu thành không dấu
        $unwanted_array = array(
            'á' => 'a',
            'à' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            'ê' => 'e',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'đ' => 'd',
            'Á' => 'a',
            'À' => 'a',
            'Ả' => 'a',
            'Ã' => 'a',
            'Ạ' => 'a',
            'Ă' => 'a',
            'Ắ' => 'a',
            'Ằ' => 'a',
            'Ẳ' => 'a',
            'Ẵ' => 'a',
            'Ặ' => 'a',
            'Â' => 'a',
            'Ấ' => 'a',
            'Ầ' => 'a',
            'Ẩ' => 'a',
            'Ẫ' => 'a',
            'Ậ' => 'a',
            'É' => 'e',
            'È' => 'e',
            'Ẻ' => 'e',
            'Ẽ' => 'e',
            'Ẹ' => 'e',
            'Ê' => 'e',
            'Ế' => 'e',
            'Ề' => 'e',
            'Ể' => 'e',
            'Ễ' => 'e',
            'Ệ' => 'e',
            'Í' => 'i',
            'Ì' => 'i',
            'Ỉ' => 'i',
            'Ĩ' => 'i',
            'Ị' => 'i',
            'Ó' => 'o',
            'Ò' => 'o',
            'Ỏ' => 'o',
            'Õ' => 'o',
            'Ọ' => 'o',
            'Ô' => 'o',
            'Ố' => 'o',
            'Ồ' => 'o',
            'Ổ' => 'o',
            'Ỗ' => 'o',
            'Ộ' => 'o',
            'Ơ' => 'o',
            'Ớ' => 'o',
            'Ờ' => 'o',
            'Ở' => 'o',
            'Ỡ' => 'o',
            'Ợ' => 'o',
            'Ú' => 'u',
            'Ù' => 'u',
            'Ủ' => 'u',
            'Ũ' => 'u',
            'Ụ' => 'u',
            'Ư' => 'u',
            'Ứ' => 'u',
            'Ừ' => 'u',
            'Ử' => 'u',
            'Ữ' => 'u',
            'Ự' => 'u',
            'Ý' => 'y',
            'Ỳ' => 'y',
            'Ỷ' => 'y',
            'Ỹ' => 'y',
            'Ỵ' => 'y',
            'Đ' => 'd'
        );

        return strtr($str, $unwanted_array);
    }
}
