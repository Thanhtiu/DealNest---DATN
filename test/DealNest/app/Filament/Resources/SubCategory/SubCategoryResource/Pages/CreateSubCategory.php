<?php

namespace App\Filament\Resources\SubCategory\SubCategoryResource\Pages;

use App\Filament\Resources\SubCategory\SubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubCategory extends CreateRecord
{
    protected static string $resource = SubCategoryResource::class;

    protected ?string $heading = 'Thể loại';
    public function getBreadcrumb(): string
    {
        return 'Thêm thể loại'; 
    }
}