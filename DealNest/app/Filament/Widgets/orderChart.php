<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
class orderChart extends ChartWidget
{
    protected static ?string $heading = 'Tổng số đơn hàng theo từng tháng';

   

protected function getData(): array
{
    // Lấy số lượng đơn hàng theo từng tháng
    $data = DB::table('orders')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total_orders'))  // Lấy tháng và số lượng đơn hàng
        ->groupBy(DB::raw('MONTH(created_at)'))  // Nhóm theo tháng
        ->orderBy(DB::raw('MONTH(created_at)'))  // Sắp xếp theo tháng (tăng dần)
        ->get();

    // Tạo dữ liệu cho chart
    return [
        'datasets' => [
            [
                'label' => 'Số lượng đơn hàng theo tháng',
                'data' => $data->map(fn ($item) => $item->total_orders),  // Số lượng đơn hàng của từng tháng
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
