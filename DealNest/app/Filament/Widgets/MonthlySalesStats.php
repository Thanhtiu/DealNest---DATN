<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class MonthlySalesStats extends BaseWidget
{
    protected static ?int $order = 2;  
    protected function getStats(): array
    {
        // Lấy tổng doanh thu theo từng tháng
        $data = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total_sales'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Tạo một mảng để lưu các thống kê
        $stats = [];

        // Duyệt qua dữ liệu và tạo Stat cho mỗi tháng
        foreach ($data as $item) {
            $monthName = 'Tháng ' . $item->month;
            $sales = number_format($item->total_sales, 0, ',', '.');  // Định dạng doanh thu

            // Tạo Stat cho mỗi tháng
            $stats[] = Stat::make($monthName, $sales)
                ->description('Tổng doanh thu trong ' . $monthName)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary');  // Màu sắc có thể thay đổi
        }

        return $stats;
    }
}
