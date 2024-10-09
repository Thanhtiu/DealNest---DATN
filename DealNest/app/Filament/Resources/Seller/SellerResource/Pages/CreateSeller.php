<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeller extends CreateRecord
{
    protected ?string $heading = 'Cửa hàng';
    protected static string $resource = SellerResource::class;

    public function getBreadcrumb(): string
    {
        return 'Thêm cửa hàng'; 
    }

}
