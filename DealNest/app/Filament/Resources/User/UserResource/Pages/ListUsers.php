<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use App\Filament\Resources\User\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected ?string $heading = 'Tài khoản';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Thêm tài khoản'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Danh sách tài khoản'; 
    }
}
