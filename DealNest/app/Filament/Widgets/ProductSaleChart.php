<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductSaleChart extends ChartWidget
{
    protected static ?string $heading = 'Sản phẩm bán chạy hàng đầu';

    protected function getData(): array
{
    // Lấy 5 sản phẩm có doanh thu cao nhất
    $topProducts = Product::orderByDesc('sales')
        ->limit(5)
        ->get();

    // Lấy tên sản phẩm (cắt tên nếu quá dài) và doanh thu
    $productNames = $topProducts->map(function ($item) {
        return substr($item->name, 0, 15);  // Cắt tên sản phẩm xuống còn 10 ký tự
    });

    $salesData = $topProducts->pluck('sales');  // Lấy doanh thu (sales)

    return [
        'datasets' => [
            [
                'label' => 'Top sản phẩm bán chạy',
                'data' => $salesData,
                'backgroundColor' => self::$color,  // Đặt màu sắc cho biểu đồ
            ],
        ],
        'labels' => $productNames,  // Hiển thị tên sản phẩm, giới hạn 10 ký tự
    ];
}


    protected function getType(): string
    {
        return 'bar';
    }
}
