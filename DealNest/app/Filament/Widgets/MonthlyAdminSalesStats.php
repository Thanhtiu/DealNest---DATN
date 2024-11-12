<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;

class MonthlyAdminSalesStats extends BaseWidget
{
    protected static ?int $order = 1;  
    protected function getStats(): array
    {
        // Lấy tổng doanh thu từ bảng orders theo từng tháng
        $monthlySales = Order::selectRaw('SUM(total) as total_sales, MONTH(created_at) as month, YEAR(created_at) as year')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        // Lấy 5% doanh thu của mỗi tháng
        $salesData = $monthlySales->map(function ($item) {
            return $item->total_sales * 0.05;  // Lấy 5% doanh thu
        });

        // Lấy tháng và năm để làm nhãn
        $labels = $monthlySales->map(function ($item) {
            return $item->month . '/' . $item->year;  // Định dạng tháng/năm
        });

        // Trả về stat với biểu đồ doanh thu admin (5%)
        return [
            Stat::make('Doanh thu admin (5%)', number_format($salesData->sum()))  // Tổng doanh thu admin 5% theo tháng
                ->description('Tổng doanh thu admin từ 5% của mỗi tháng')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart($salesData->toArray())  // Dữ liệu cho biểu đồ
               
        ];
    }
}
