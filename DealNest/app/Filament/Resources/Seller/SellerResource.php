<?php

namespace App\Filament\Resources\Seller;

use App\Filament\Resources\Seller\SellerResource\Pages;
use App\Filament\Resources\Seller\SellerResource\RelationManagers;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Danh sách cửa hàng';

    protected static ?string $navigationBadgeTooltip = 'Số lượng cửa hàng';

    protected static ?string $modelLabel = 'Cửa hàng';

    protected static ?int $navigationSort = 8; // vị trí hiển thị


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2) // Tạo lưới với 2 cột
                ->schema([
                    TextInput::make('store_name')
                        ->label('Tên cửa hàng')
                        ->columnSpan(1), // Chiếm 1 cột
    
                    TextInput::make('store_email')
                        ->label('Email')
                        ->disabled()
                        ->columnSpan(1), // Chiếm 1 cột
                ]),
    
            Grid::make(2) // Tạo một lưới khác với 2 cột
                ->schema([
                    TextInput::make('store_phone')
                        ->label('Điện thoại')
                        ->disabled()
                        ->columnSpan(1), // Chiếm 1 cột
    
                    Toggle::make('status')
                        ->label('Trạng thái')
                        ->inline(false) // Đặt ở giữa cột để tạo sự cân đối
                        ->columnSpan(1) // Chiếm 1 cột
                        ->reactive(), // Để trường này phản ứng với các thay đổi
                ]),
    
            Grid::make(1) // Tạo lưới với 1 cột cho trường select
                ->schema([
                    Select::make('note')
                        ->label('Lý do khóa cửa hàng')
                        ->options([
                            'Vi phạm chính sách bán hàng' => 'Vi phạm chính sách bán hàng',
                            'Sản phẩm không tuân thủ quy định' => 'Sản phẩm không tuân thủ quy định',
                            'Phản hồi kém từ khách hàng' => 'Phản hồi kém từ khách hàng',
                            'Vi phạm bản quyền' => 'Vi phạm bản quyền',
                            'Thông tin gian lận hoặc sai lệch' => 'Thông tin gian lận hoặc sai lệch',
                            'Không tuân thủ yêu cầu từ Shopee' => 'Không tuân thủ yêu cầu từ Shopee',
                        ])
                        ->columnSpan(1) // Chiếm toàn bộ chiều rộng
                        ->reactive() // Để trường này phản ứng với các thay đổi
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Nếu giá trị khác null, cập nhật toggle status thành false
                            $set('status', $state ? false : true);
                        }),
                ]),
        ]);
    

    

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('store_name')->label('Tên cửa hàng')->sortable()->searchable(),
                TextColumn::make('store_email')->label('Email')->sortable()->searchable(),
                TextColumn::make('store_phone')->label('Điện thoại')->sortable()->searchable(),
                BooleanColumn::make('status')->label('Trạng thái')->sortable()->searchable(),
                TextColumn::make('note')
                ->label('Hoạt động')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => $state ?? 'Đang hoạt động'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Xem'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
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
        return 'Quản lý cửa hàng'; 
    }
}
