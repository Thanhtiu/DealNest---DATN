<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Product;

class NewProductsStats extends BaseWidget
{
    protected static ?int $order = 3;  
    protected function getStats(): array
    {
        // Lấy dữ liệu chart của bạn
        $data = Trend::model(Product::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();  // Đếm số sản phẩm mới được thêm vào mỗi ngày

        // Tính tổng số sản phẩm mới trong tháng
        $totalNewProducts = $data->sum(fn (TrendValue $value) => $value->aggregate);

        return [
            Stat::make('Sản phẩm mới', number_format($totalNewProducts))
                ->description('Số sản phẩm mới được thêm vào trong tháng')
                ->descriptionIcon('heroicon-m-arrow-trending-up')  // Biểu tượng tăng
                ->color('success')  // Màu sắc stat
                ->chart($data->map(fn (TrendValue $value) => $value->aggregate)->toArray())  // Biểu đồ thể hiện số lượng sản phẩm mỗi ngày
                
        ];
    }
}
