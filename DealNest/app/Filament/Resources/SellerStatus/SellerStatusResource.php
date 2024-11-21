<?php

namespace App\Filament\Resources\SellerStatus;

use App\Filament\Resources\SellerStatus\SellerStatusResource\Pages;
use App\Filament\Resources\SellerStatus\SellerStatusResource\RelationManagers;
use App\Models\Product;
use App\Models\Seller;
use Faker\Provider\ar_EG\Text;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SellerStatusResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    

    protected static ?string $navigationGroup = 'Cửa hàng';
    
    protected static ?string $navigationBadgeTooltip = 'Tổng số cửa hàng';

    protected static ?string $modelLabel = 'Danh sách cửa hàng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Tên cửa hàng')
                ->disabled(),
            
            // Sử dụng quan hệ để lấy thông tin email của user
            Select::make('user.email')
            ->relationship('user','email')
            ->label('Email')->disabled(),
    
            // Sử dụng quan hệ để lấy thông tin phone của user
            Select::make('user.phone')
            ->relationship('user','phone')
            ->label('Điện thoại')->disabled(),
    
            // Sử dụng quan hệ để lấy thông tin địa chỉ của user (giả sử địa chỉ được lưu trong bảng user hoặc seller)
            Select::make('address.string_address')
            ->relationship('address','string_address')
            ->label('Địa chỉ')->disabled(),
            
            Select::make('status')
                ->options([
                    '2' => 'Chờ phê duyệt',
                    '1' => 'Đã phê duyệt ',
                    '0' => 'Từ chối'
                ])
                ->placeholder('Chọn trạng thái')
                ->label('Trạng thái'),
                Select::make('note')
                ->options([
                    'Thông tin không đầy đủ hoặc không chính xác' => 'Thông tin không đầy đủ hoặc không chính xác',
                    'Tài khoản bị nghi ngờ gian lận' => 'Tài khoản bị nghi ngờ gian lận',
                    'Vi phạm các quy định của Shopee' => 'Vi phạm các quy định của DealNest',
                    'Địa chỉ hoặc khu vực không hỗ trợ' => 'Địa chỉ hoặc khu vực không hỗ trợ',
                    'Tài khoản bị khóa hoặc bị cấm trước đó' => 'Tài khoản bị khóa hoặc bị cấm trước đó',
                    'Chưa hoàn thành quy trình xác minh' => 'Chưa hoàn thành quy trình xác minh',
                ])
                
                ->placeholder('Chọn lý do')
                ->label('Ghi chú')
                

            ]);

            
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')->label('Tên cửa hàng'),

            TextColumn::make(name: 'user.email')->label('Email'),
            TextColumn::make('status')
            ->label('Trạng thái')
            ->sortable()
            ->searchable()
            ->icon(fn ($state) => match ($state) {
                0 => 'heroicon-o-lock-closed',         // Icon khóa cho trạng thái 0
                1 => 'heroicon-o-check-circle', // Icon check-circle cho trạng thái 1
                2 => 'heroicon-o-clock',        // Icon clock cho trạng thái 2
                default => null,
            })
            ->color(fn ($state) => match ($state) {
                0 => 'danger',    // Màu đỏ cho trạng thái 0 (Đã khóa)
                1 => 'success',  // Màu xanh cho trạng thái 1 (Đã duyệt)
                2 => 'primary', // Màu vàng cho trạng thái 2 (Chờ duyệt)
                default => 'gray', // Màu xám mặc định
            })
            ->formatStateUsing(fn ($state) => match ($state) {
                0 => 'Đã khóa',
                1 => 'Đã duyệt',
                2 => 'Chờ duyệt',
                default => (string) $state, // Trả về giá trị gốc nếu không phải các trạng thái trên
            }),

            TextColumn::make('note')
                ->label('Ghi chú')
                ->sortable()
                ->searchable()
                ->limit(40)

        ])
            ->filters([
                //
            ])
            ->actions([
                
                Action::make('Approve')
                ->label(fn (Seller $record) => match ($record->status) {
                    0 => 'Đã khóa',
                    1 => 'Đã duyệt',
                    2 => 'Duyệt',
                    default => '',
                })
                ->icon(fn (Seller $record) => match ($record->status) {
                    0 => 'heroicon-o-lock-closed',   // Icon khóa cho trạng thái 0 (Đã khóa)
                    1 => 'heroicon-o-check-circle',  // Icon check-circle cho trạng thái 1 (Đã duyệt)
                    2 => 'heroicon-o-check',         // Icon clock cho trạng thái 2 (Chờ duyệt)
                    default => '',
                })
                ->action(function (Seller $record) {
                    // Cập nhật trạng thái thành 'Đã duyệt' (status = 1) khi trạng thái là 'Chờ duyệt' (status = 2)
                    if ($record->status === 2) {
                        $record->status = 1;  // Cập nhật trạng thái thành 'Đã duyệt' (status = 1)
                        $record->save();
                    }
                })
                ->color(fn (Seller $record) => match ($record->status) {
                    0 => 'red',    // Màu đỏ cho trạng thái 'Đã khóa' (status = 0)
                    1 => 'green',  // Màu xanh cho trạng thái 'Đã duyệt' (status = 1)
                    2 => 'success', // Màu vàng cho trạng thái 'Chờ duyệt' (status = 2)
                    default => 'gray',
                })
                ->visible(fn (Seller $record) => $record->status === 2) // Chỉ hiển thị nếu trạng thái là 'Chờ duyệt' (status = 2)
                ->disabled(fn (Seller $record) => $record->status !== 2), // Chỉ kích hoạt nếu trạng thái là 'Chờ duyệt' (status = 2)
                
            


                Tables\Actions\EditAction::make()->label('Chi tiết'),


            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListSellerStatuses::route('/'),
            'create' => Pages\CreateSellerStatus::route('/create'),
            'edit' => Pages\EditSellerStatus::route('/{record}/edit'),
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
        return 'Danh sách cửa hàng'; 
    }
}
