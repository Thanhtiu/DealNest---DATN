<?php

namespace App\Filament\Resources\Product\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use App\Notifications\ProductUpdatedNotification;
class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected ?string $heading = 'Sản phẩm';

    public function getBreadcrumb(): string
    {
        return 'Duyệt sản phẩm'; 
    }
    protected function afterSave()
    {
         // Lấy đối tượng sản phẩm hiện tại
         $product = $this->record;

         // Gửi thông báo cho người sở hữu sản phẩm (ví dụ, Seller)
         $product->seller->notify(new ProductUpdatedNotification($product));
    // Chuyển hướng về danh sách sản phẩm
         return redirect()->route('filament.admin.resources.product.products.index');
    }

    
}
