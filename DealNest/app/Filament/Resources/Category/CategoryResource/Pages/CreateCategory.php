<?php

namespace App\Filament\Resources\Category\CategoryResource\Pages;

use App\Filament\Resources\Category\CategoryResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Actions\ButtonAction;

class CreateCategory extends CreateRecord
{
    protected ?string $heading = 'Danh mục';
    protected static string $resource = CategoryResource::class;

    public function getBreadcrumb(): string
    {
        return 'Thêm danh mục'; 
    }



   

}