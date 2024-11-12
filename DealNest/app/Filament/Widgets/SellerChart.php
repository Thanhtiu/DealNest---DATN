<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
class SellerChart extends ChartWidget
{
    protected static ?string $heading = 'Cửa hàng có doanh thu hàng đầu sản';

    protected static ?int $sort = 11;

    protected function getData(): array
    {
        // Lấy tổng doanh thu nhóm theo seller_id và join với bảng sellers để lấy tên cửa hàng
        $data = DB::table('orders')
            ->join('sellers', 'orders.seller_id', '=', 'sellers.id')  // Join với bảng sellers để lấy tên cửa hàng
            ->select('orders.seller_id', 'sellers.name', DB::raw('SUM(orders.total) as total_sales'))  // Lấy store_name từ sellers
            ->groupBy('orders.seller_id', 'sellers.name')  // Nhóm theo seller_id và store_name
            ->orderByDesc('total_sales')  // Sắp xếp giảm dần theo tổng doanh thu
            ->limit(5)  // Giới hạn lấy top 5 cửa hàng có doanh thu cao nhất
            ->get();
    
        // Tạo dữ liệu cho chart
        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu của cửa hàng',
                    'data' => $data->map(fn ($item) => $item->total_sales),  // Doanh thu của các cửa hàng
                ],
            ],
            'labels' => $data->map(fn ($item) => $item->name),  // Tên cửa hàng từ bảng sellers
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
