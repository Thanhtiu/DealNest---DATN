<?php

namespace App\Filament\Resources\SubCategory\SubCategoryResource\Pages;

use App\Filament\Resources\SubCategory\SubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubCategory extends EditRecord
{
    protected static string $resource = SubCategoryResource::class;

    protected ?string $heading = 'Thể loại';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Tùy chỉnh thể loại'; 
    }
}