<?php

namespace App\Filament\Resources\Category\CategoryResource\Pages;

use App\Filament\Resources\Category\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected ?string $heading = 'Danh mục';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Thêm danh mục'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Danh sách danh mục'; 
    }


}