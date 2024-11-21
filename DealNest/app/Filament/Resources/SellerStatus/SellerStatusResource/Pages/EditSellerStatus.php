<?php

namespace App\Filament\Resources\SellerStatus\SellerStatusResource\Pages;

use App\Filament\Resources\SellerStatus\SellerStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellerStatus extends EditRecord
{
    protected static string $resource = SellerStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave()
    {
    // Chuyển hướng về danh sách sản phẩm
         return redirect()->route('filament.admin.resources.seller-status.seller-statuses.index');
    }
}
