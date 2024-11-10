<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
class revenueChart extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu của sàn';

    protected function getData(): array
    {
        // Lấy tổng doanh thu theo từng tháng
        $data = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total_sales'))  // Lấy tháng và tổng doanh thu
            ->groupBy(DB::raw('MONTH(created_at)'))  // Nhóm theo tháng
            ->orderBy(DB::raw('MONTH(created_at)'))  // Sắp xếp theo tháng (tăng dần)
            ->get();
    
        // Tạo dữ liệu cho chart
        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu toàn sàn theo tháng',
                    'data' => $data->map(fn ($item) => $item->total_sales),  // Doanh thu của từng tháng
                ],
            ],
            'labels' => $data->map(fn ($item) => 'Tháng ' . $item->month),  // Tên tháng
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
