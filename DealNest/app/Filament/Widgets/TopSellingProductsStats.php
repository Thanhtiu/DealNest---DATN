<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;

class TopSellingProductsStats extends BaseWidget
{
    protected static ?int $order = 5;  
    protected function getStats(): array
    {
        // Lấy 5 sản phẩm có doanh thu cao nhất
        $topProducts = Product::orderByDesc('sales')
            ->limit(5)
            ->get();

        // Lấy tên sản phẩm (cắt tên nếu quá dài) và doanh thu
        $productNames = $topProducts->map(function ($item) {
            return substr($item->name, 0, 15);  // Cắt tên sản phẩm xuống còn 15 ký tự
        });

        $salesData = $topProducts->pluck('sales');  // Lấy doanh thu (sales)

        // Trả về các stat cho Top sản phẩm bán chạy
        return [
            Stat::make('Top sản phẩm bán chạy', number_format($salesData->sum()))  // Tổng doanh thu của 5 sản phẩm bán chạy nhất
                ->description('Tổng doanh thu từ 5 sản phẩm bán chạy nhất')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($salesData->toArray()) // Biểu đồ doanh thu
                
        ];
    }
}
