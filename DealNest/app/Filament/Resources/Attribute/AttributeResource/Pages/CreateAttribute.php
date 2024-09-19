<?php

namespace App\Filament\Resources\Attribute\AttributeResource\Pages;

use App\Filament\Resources\Attribute\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;
    protected ?string $heading = 'Thuộc tính sản phẩm';

    public function getBreadcrumb(): string
    {
        return 'Thêm thuộc tính'; 
    }
}
