<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeller extends EditRecord
{
    protected static string $resource = SellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected ?string $heading = 'Cửa hàng';

    public function getBreadcrumb(): string
    {
        return 'Tùy chỉnh cửa hàng'; 
    }

}
