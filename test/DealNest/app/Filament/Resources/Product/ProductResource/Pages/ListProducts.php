<?php

namespace App\Filament\Resources\Product\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected ?string $heading = 'Sản phẩm';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()->label('Thêm sản phẩm'),
        ];
    }
    public function getBreadcrumb(): string
    {
        return 'Danh sách sản phẩm'; 
    }
}
