<?php

namespace App\Filament\Resources\Category\CategoryResource\Pages;

use App\Filament\Resources\Category\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected ?string $heading = 'Danh mục';

    public function getBreadcrumb(): string
    {
        return 'Tùy chỉnh danh mục'; 
    }

}