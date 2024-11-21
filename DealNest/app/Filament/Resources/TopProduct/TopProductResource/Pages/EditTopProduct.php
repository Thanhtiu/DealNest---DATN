<?php

namespace App\Filament\Resources\TopProduct\TopProductResource\Pages;

use App\Filament\Resources\TopProduct\TopProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopProduct extends EditRecord
{
    protected static string $resource = TopProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
