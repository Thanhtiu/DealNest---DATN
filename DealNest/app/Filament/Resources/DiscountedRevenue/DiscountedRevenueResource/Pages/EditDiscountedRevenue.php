<?php

namespace App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource\Pages;

use App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiscountedRevenue extends EditRecord
{
    protected static string $resource = DiscountedRevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
