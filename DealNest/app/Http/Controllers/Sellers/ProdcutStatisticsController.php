<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Country;

class ProdcutStatisticsController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        // Lấy top 5 sản phẩm bán chạy nhất tổng thể
        $bestSeller = Product::where('seller_id', $sellerId)
            ->orderBy('sales', 'desc')
            ->take(5)
            ->get();

        $countSales = $bestSeller->sum('sales');
        $inventory = $bestSeller->sum('quantity');

        // Thống kê sản phẩm bán chạy nhất theo từng tháng
        $monthlyBestSellers = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.id, products.name, SUM(order_items.quantity) as total_quantity, MONTH(orders.delivery_date) as month')
            ->where('orders.seller_id', $sellerId)
            ->where(function ($query) {
                $query->where('orders.status', 'waiting_for_delivery')
                    ->orWhere('orders.status', 'completed');
            })
            ->groupBy('products.id', 'products.name', 'month')
            ->orderBy('month')
            ->orderBy('total_quantity', 'desc')
            ->get();

        // Lấy sản phẩm có lượt bán cao nhất trong mỗi tháng
        $topProductsData = $monthlyBestSellers->groupBy('month')->map(function ($products) {
            // Lấy sản phẩm có lượt bán cao nhất trong tháng
            return $products->first(); // Vì đã sắp xếp theo total_quantity giảm dần, lấy phần tử đầu tiên
        });

        // Định dạng kết quả (nếu cần thiết)
        $topProductsData = $topProductsData->values();
        return view('sellers.productStatistics.index', compact('inventory', 'bestSeller', 'countSales', 'topProductsData'));
    }


    public function detail($id)
    {
        $product = Product::with(['productVariants', 'category.parent'])->findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        $country = Country::all();

        return view('sellers.productStatistics.detail', compact('categories', 'product', 'country'));
    }
}
