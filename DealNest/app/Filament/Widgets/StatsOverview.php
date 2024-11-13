<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
class StatsOverview extends BaseWidget
{
    protected static ?int $order = 4;  
    
    protected function getStats(): array
    {
        // Lấy dữ liệu đơn hàng theo tháng
        $data = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total_orders'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Tạo dữ liệu cho chart
        $chartData = [
            'datasets' => [
                [
                    'label' => 'Số lượng đơn hàng theo tháng',
                    'data' => $data->map(fn ($item) => $item->total_orders),
                ],
            ],
            'labels' => $data->map(fn ($item) => 'Tháng ' . $item->month),
        ];

        // Đảm bảo truyền cả tên và giá trị cho Stat::make()
        return [
            Stat::make('Số lượng đơn hàng', $data->sum('total_orders'))  // Truyền tên và giá trị vào đây
                ->description('Tổng số đơn hàng theo tháng')
                ->chart($chartData)  // Thêm biểu đồ vào stat
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
