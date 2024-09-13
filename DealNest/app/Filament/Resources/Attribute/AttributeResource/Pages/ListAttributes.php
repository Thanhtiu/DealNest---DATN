<?php

namespace App\Filament\Resources\Attribute\AttributeResource\Pages;

use App\Filament\Resources\Attribute\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributes extends ListRecords
{
    protected static string $resource = AttributeResource::class;

    protected ?string $heading = 'Thuộc tính sản phẩm';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Thêm thuộc tính'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Danh sách thuộc tính'; 
    }
}
