<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use App\Filament\Resources\User\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected ?string $heading = 'Tài khoản';
    protected static string $resource = UserResource::class;

    public function getBreadcrumb(): string
    {
        return 'Thêm tài khoản'; 
    }
}
