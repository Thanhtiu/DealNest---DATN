<?php

namespace App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource\Pages;

use App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscountedRevenue extends CreateRecord
{
    protected static string $resource = DiscountedRevenueResource::class;

    protected ?string $heading = 'Doanh thu từ chiếc khấu';
}
