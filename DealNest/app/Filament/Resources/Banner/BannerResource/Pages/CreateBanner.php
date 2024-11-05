<?php

namespace App\Filament\Resources\Banner\BannerResource\Pages;

use App\Filament\Resources\Banner\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected ?string $heading = 'Banner';
    public function getBreadcrumb(): string
    {
        return 'Thêm banner'; 
    }
    protected function afterSave()
    {
    // Chuyển hướng về danh sách sản phẩm
         return redirect()->route('filament.admin.resources.banner.banners.index');
    }

}
