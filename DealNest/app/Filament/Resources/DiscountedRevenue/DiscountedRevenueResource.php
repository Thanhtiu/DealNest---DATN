<?php

namespace App\Filament\Resources\DiscountedRevenue;

use App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource\Pages;
use App\Filament\Resources\DiscountedRevenue\DiscountedRevenueResource\RelationManagers;
use App\Models\DiscountedRevenue\DiscountedRevenue;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Vouver;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountedRevenueResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = 'Doanh thu từ chiếc khấu';

    protected static ?string $navigationBadgeTooltip = 'Số lượng cửa hàng';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Doanh thu từ chiếc khấu';

    protected static ?int $navigationSort = 7; 

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Trường ID
            TextInput::make('id')
                ->label('Mã hóa đơn')
                ->disabled()  // ID thường là khóa chính, không nên chỉnh sửa
                ->required(),

            // Trường User ID
            Select::make('user_id')
                ->label('Người dùng')
                ->options(User::all()->pluck('name', 'id'))
                ->required(),

            // Trường Seller ID
            Select::make('seller_id')
                ->label('Cửa hàng')
                ->options(Seller::all()->pluck('name', 'id'))
                ->required(),

            // Trường Status
            Select::make('status')
                ->label('Trạng thái')
                ->options([
                    'pending' => 'Chờ xử lý',
                    'completed' => 'Hoàn tất',
                    'cancelled' => 'Hủy bỏ',
                ])
                ->required(),

            // Trường Tổng giá trị đơn hàng
            TextInput::make('total')
                ->label('Giá trị đơn hàng'),
               

            // Trường Discount Rate
            TextInput::make('discount_rate')
                ->label('Tổng tiền chiết khẩu trên đơn'),

            // Trường Percent
            TextInput::make('percent')
                ->label('Phần trăm trên đơn'),

            // Trường Ngày giao hàng
            DatePicker::make('delivery_date')
                ->label('Ngày giao hàng')
                ->required(),

            // Trường Payment Method
            TextInput::make('payment_method')
                ->label('Phương thức thanh toán'),

            // Trường Payment Status
            TextInput::make('payment_status')
                ->label('Trạng thái thanh toán'),

            // Trường Cancellation Reason
            TextInput::make('cancellation_reason')
                ->label('Lý do hủy đơn')
                ->nullable(),

            // Trường Địa chỉ
            TextInput::make('address')
                ->label('Địa chỉ giao hàng')
                ->required(),

            // Trường Voucher ID
            TextInput::make('voucher_id')
                ->label('Voucher')
                ->default('voucher.name')
                ->nullable(),

            // Trường Số điện thoại
            TextInput::make('phone')
                ->label('Số điện thoại')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('Mã hóa đơn')
                ->sortable()
                ->searchable(),
            
            TextColumn::make('seller.name')
                ->label('Cửa hàng')
                ->sortable()
                ->searchable(),
            
            TextColumn::make('total')
                ->label('Giá trị đơn hàng')
                ->sortable()
                ->searchable()
                ->getStateUsing(fn($record) => number_format($record->total, 0, ',', '.') . ' VNĐ'),  // Thêm VNĐ
            
            TextColumn::make('percent')
                ->label('Phần trăm trên đơn')
                ->sortable()
                ->searchable()
                ->getStateUsing(fn($record) => number_format($record->percent * 100, 2, ',', '.') . ' %'),  // Thêm % vào phần trăm
            
            TextColumn::make('discount_rate')
                ->label('Tổng tiền chiết khẩu trên đơn')
                ->sortable()
                ->searchable()
                ->getStateUsing(fn($record) => number_format($record->discount_rate, 0, ',', '.') . ' VNĐ'),  // Thêm VNĐ
                     
            ])
            ->filters([
                //
            ])
            ->actions([
                    Tables\Actions\ViewAction::make()->label('Xem'),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                  
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
            'index' => Pages\ListDiscountedRevenues::route('/'),
            'create' => Pages\CreateDiscountedRevenue::route('/create'),
            'edit' => Pages\EditDiscountedRevenue::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 1 ? 'primary' : 'warning';
    }

    public static function getBreadcrumb(): string
    {
        return 'Doanh thu từ chiếc khấu'; 
    }
    
}
