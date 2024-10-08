<?php

namespace App\Filament\Resources\Banner\BannerResource\Pages;

use App\Filament\Resources\Banner\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    protected ?string $heading = 'Banner';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Thêm banner'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Danh sách banner'; 
    }
}
