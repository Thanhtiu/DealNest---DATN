<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index(Request $request, $id)
    {
        // Lấy thông tin shop
        $shop = Seller::find($id);
        $countProduct = Product::where('seller_id', $id)->count();

        // Tính thời gian tham gia của shop
        $shopJoinDate = $shop->created_at;
        $currentDate = Carbon::now();
        $join = round($shopJoinDate->diffInDays($currentDate));

        // Lấy 3 sản phẩm bán chạy nhất nhưng thuộc các thể loại khác nhau
        $topProducts = Product::where('seller_id', $id)
            ->orderBy('sales', 'desc')
            ->distinct('category_id')
            ->take(3)
            ->get();

        // Lấy ra các category_id từ 3 sản phẩm bán chạy nhất
        $categoryIds = $topProducts->pluck('category_id');

        // Lấy tên các thể loại tương ứng từ các category_id này
        $categories = Category::whereIn('id', $categoryIds)->pluck('name', 'id');

        // Lọc sản phẩm trong 30 ngày qua (nếu cần hiển thị các sản phẩm mới nhất)
        $newProducts = Product::where('seller_id', $id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        // Lọc sản phẩm theo thể loại (nếu có yêu cầu từ người dùng)
        if ($request->has('category_id')) {
            $categoryId = $request->input('category_id');
            $filteredProducts = Product::where('seller_id', $id)
                ->where('category_id', $categoryId)
                ->get();
        } else {
            // Nếu không chọn thể loại nào thì hiển thị tất cả sản phẩm của shop
            $filteredProducts = Product::where('seller_id', $id)->get();
        }


        return view('client.shop', compact(
            'shop',
            'join',
            'topProducts',
            'newProducts',
            'categories',
            'filteredProducts',
            'countProduct'
        ));
    }
}




