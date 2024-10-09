<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSellers extends ListRecords
{
    protected static string $resource = SellerResource::class;

    protected ?string $heading = 'Cửa hàng';

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
     public function getBreadcrumb(): string
    {
        return 'Danh sách cửa hàng'; 
    }
}
