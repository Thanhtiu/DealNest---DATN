<?php

namespace App\Filament\Resources\TopProduct\TopProductResource\Pages;

use App\Filament\Resources\TopProduct\TopProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopProducts extends ListRecords
{
    protected static string $resource = TopProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    public function getTableRecordKey($record): string
    {
        // Đảm bảo trả về khóa hợp lệ, có thể là product_id
        return (string) $record->product_id;
    }
}
