<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\UserResource\Pages;
use App\Filament\Resources\User\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Illuminate\Support\Facades\Storage;





class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Tài khoản';

    protected static ?string $navigationBadgeTooltip = 'Số lượng tài khoản';

    protected static ?string $modelLabel = 'Tài khoản';

    protected static ?int $navigationSort = 1; // vị trí hiển thị

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2)
                ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->label('Tên đầy đủ'),

                    FileUpload::make('image')
    ->label('Hình ảnh')
    ->image()
    ->disk('uploads')
    ->dehydrateStateUsing(function ($state) {
        // Kiểm tra nếu $state là một mảng và lấy tên tệp từ đó
        if (is_array($state)) {
            // Giả sử $state chứa một mảng với một khóa duy nhất, lấy tên tệp từ đó
            return $state[array_key_first($state)] ?? 'user_default.jpg';
        }
        // Nếu không phải mảng, trả về chính nó hoặc giá trị mặc định
        return $state ?: 'user_default.jpg';
    }),


                
                    
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->required()
                    ->dehydrated()
                    ->unique(User::class, 'email', ignoreRecord: true)
                    ->label('Email'),
                    TextInput::make('password')
                    ->label('Mật khẩu')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($livewire) => $livewire instanceof CreateUser)
            ]),

            Grid::make(2)
                ->schema([
                    TextInput::make('phone')
                        ->maxLength(15)
                        ->required()
                        ->tel()
                        ->unique(User::class, 'phone', ignoreRecord: true)
                        ->label('Điện thoại'),
                    Select::make('role')
                        ->required()
                        ->options([
                            'seller' => "Người bán hàng",
                            'buyer' => "Người mua hàng",
                             'staff' => "Nhân viên"
                        ])
                        ->default('buyer')
                        ->label('Vai trò'),
                    Toggle::make('is_active')
                        ->label('Kích hoạt tài khoản')
                        ->default(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')->label('Tên')->sortable()->searchable(),
            TextColumn::make('email')->label('Email')->sortable()->searchable(),
            TextColumn::make('role')
            ->label('Chức vụ')
            ->sortable()
            ->searchable()
            ->formatStateUsing(function ($state) {
                $roles = [
                    'seller' => 'Người bán hàng',
                    'buyer' => 'Người mua hàng',
                    'staff' => 'Nhân viên',              
                ];

                return $roles[$state] ?? $state; // Trả về giá trị tiếng Việt hoặc giá trị gốc nếu không tìm thấy
            }),
            ImageColumn::make('image')
    ->label('Hình ảnh')
    ->disk('uploads') // Đảm bảo sử dụng đúng disk
    ->url(fn ($record) => Storage::disk('uploads')->url($record->image)) // Tạo đường dẫn URL
    ->width(100)
    ->height(100),

        ])
            ->filters([
                QueryBuilder::make()
                ->constraints([
                    SelectConstraint::make('role')
                        ->options([
                            'seller' => 'Người bán hàng',
                            'buyer' => 'Người mua hàng',
                            'staff' => 'Nhân viên',
                            // Không thêm admin ở đây
                        ]),
                ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Xem'),
                    Tables\Actions\EditAction::make()->label('Sửa'),
                    Tables\Actions\DeleteAction::make()->label('Xóa'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Thêm điều kiện để loại bỏ người dùng có vai trò là admin
        return parent::getEloquentQuery()->where('role', '!=', 'admin');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'primary' : 'warning';
    }

    public static function getBreadcrumb(): string
    {
        return 'Quản lý tài khoản';
    }

    

}
