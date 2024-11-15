<?php

namespace App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource\Pages;

use App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiscountedRevenues extends ListRecords
{
    protected static string $resource = DiscountedRevenueResource::class;

    protected ?string $heading = 'Doanh thu từ chiếc khấu';
    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
    public function getBreadcrumb(): string
    {
        return 'Doanh thu từ chiếc khấu'; 
    }
}
