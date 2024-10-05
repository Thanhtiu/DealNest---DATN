<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Auth;

class EditProfile extends BaseEditProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.auth.edit-profile';

    protected static ?string $modelLabel = 'Thông tin tài khoản';

    protected ?string $heading = 'Thông tin tài khoản';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent()->label('Tên người dùng'),
                // Trong form schema
                FileUpload::make('image')
                ->label('Hình ảnh')
                ->image()
                ->directory('users') 
                ->default(auth()->user()->image) // Lấy đường dẫn hình ảnh từ cơ sở dữ liệu
                ->required()
                ->maxSize(1024)
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    if (empty($state)) {
                        $set('image', 'users/default_avt.png');
                    }
                }),
               

                TextInput::make('phone')
                ->label('Số điện thoại')
                ->required() // Bắt buộc nhập
                ->tel() // Định dạng input là số điện thoại
                ->minLength(10) // Độ dài tối thiểu (10 chữ số)
                ->maxLength(15) // Độ dài tối đa (15 chữ số)
                ->rule('regex:/^[0-9]+$/') // Chỉ cho phép nhập số
                ->placeholder('Nhập số điện thoại'),
                TextInput::make('cccd')
                ->label('Căn cước công dân')
                ->required() // Bắt buộc nhập
                ->maxLength(12) // Độ dài tối đa 12 ký tự (thay đổi nếu cần)
                ->rule('regex:/^[0-9]{9,12}$/') // Chỉ cho phép số và độ dài từ 9 đến 12 ký tự
                ->placeholder('Nhập số CCCD'),
                $this->getEmailFormComponent()->label('Email'),
                $this->getPasswordFormComponent()->label('Mật khẩu'),
                $this->getPasswordConfirmationFormComponent()->label('Nhập lại mật khẩu'),
            ]);
    }
}
