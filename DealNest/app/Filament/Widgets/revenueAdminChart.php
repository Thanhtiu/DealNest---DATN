<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class revenueAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Tổng doanh thu DealNest theo tháng';

    protected function getData(): array
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

    return [
        'datasets' => [
            [
                'label' => 'Doanh thu admin (5%)',
                'data' => $salesData,
                'backgroundColor' => self::$color,  // Màu sắc của biểu đồ
            ],
        ],
        'labels' => $labels,  // Hiển thị tháng/năm
    ];
}


    protected function getType(): string
    {
        return 'bar';
    }
}
