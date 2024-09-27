<?php

namespace App\Filament\Resources\SubCategory\SubCategoryResource\Pages;

use App\Filament\Resources\SubCategory\SubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubCategories extends ListRecords
{
    protected static string $resource = SubCategoryResource::class;

    protected ?string $heading = 'Thể loại';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Thêm thể loại'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Danh sách thể loại'; 
    }
}