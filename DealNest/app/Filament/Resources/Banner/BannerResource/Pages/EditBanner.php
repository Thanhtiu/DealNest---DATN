<?php

namespace App\Filament\Resources\Banner\BannerResource\Pages;

use App\Filament\Resources\Banner\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected ?string $heading = 'Banner';

    public function getBreadcrumb(): string
    {
        return 'Tùy chỉnh banner'; 
    }

}
