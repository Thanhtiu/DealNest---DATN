<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Brand;

class ProdcutStatisticsController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('sellerId');

        // Lấy tất cả các cột từ bảng products
        $bestSeller = Product::where('seller_id', $sellerId)
            ->orderBy('sales', 'desc')
            ->take(5)
            ->get();

        $countSales = $bestSeller->sum('sales');


        // Lấy sản phẩm bán chạy theo từng tháng, lấy tổng số lượng
        $topSellingProducts = OrderItem::where('seller_id', $sellerId)
            ->whereIn('status', ['waiting_for_delivery', 'success']) // Chỉ tính các đơn hàng có trạng thái này
            ->selectRaw('product_id, MONTH(delivery_date) as month, SUM(quantity) as total_quantity')
            ->groupBy('product_id', 'month')
            ->orderBy('total_quantity', 'desc') // Sắp xếp theo số lượng bán giảm dần
            ->with('product') // Kết hợp với bảng products để lấy tên sản phẩm
            ->limit(5) // Giới hạn chỉ lấy 5 sản phẩm
            ->get();

        // Tạo mảng chứa dữ liệu cho từng tháng
        $topProductsData = [];
        foreach ($topSellingProducts as $product) {
            $month = $product->month;
            $topProductsData[$month][] = [
                'product_name' => $product->product->name,
                'total_quantity' => $product->total_quantity
            ];
        }
        $inventory = Product::where('seller_id', $sellerId)
        ->sum('quantity');
        return view('sellers.productStatistics.index', compact('inventory','bestSeller', 'countSales', 'topProductsData'));
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
