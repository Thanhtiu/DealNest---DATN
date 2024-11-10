<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProductChart extends ChartWidget
{
    protected static ?string $heading = 'Thống kê sản phẩm mới trong tháng';

  

    protected function getData(): array
{
    $data = Trend::model(Product::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();  // Đếm số sản phẩm mới được thêm vào mỗi ngày

    return [
        'datasets' => [
            [
                'label' => 'Sản phẩm mới',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),  // Lấy số lượng sản phẩm mỗi ngày
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),  // Lấy ngày tương ứng
    ];
}


    protected function getType(): string
    {
        return 'bar';
    }
}
