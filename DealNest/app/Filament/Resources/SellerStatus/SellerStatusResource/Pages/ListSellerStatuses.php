<?php

namespace App\Filament\Resources\SellerStatus\SellerStatusResource\Pages;

use App\Filament\Resources\SellerStatus\SellerStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSellerStatuses extends ListRecords
{
    protected static string $resource = SellerStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
