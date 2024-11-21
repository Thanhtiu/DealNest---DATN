<?php

namespace App\Filament\Resources\Order;

use App\Filament\Resources\Order\OrderResource\Pages;
use App\Filament\Resources\Order\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Top doanh thu';

    protected static ?string $navigationGroup = 'Cửa hàng';

    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Cửa hàng có doanh thu cao nhất';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Cột tên cửa hàng (seller.name)
            Tables\Columns\TextColumn::make('seller.name')
                ->label('Tên Cửa Hàng')
                ->sortable()
                ->searchable(),

            // Cột tổng doanh thu (total_sum)
            Tables\Columns\TextColumn::make('total_sum')
                ->label('Tổng Doanh Thu')
                ->sortable()
                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' VND'),

            // Cột tháng (month)
            Tables\Columns\TextColumn::make('month')
                ->label('Tháng')
                ->sortable()
                ->formatStateUsing(fn ($state) => 'Tháng ' . $state), // Hiển thị tháng với tiền tố "Tháng"
        ])
        ->query(fn (Order $query) => $query->selectRaw('MAX(orders.id) as id, orders.seller_id, SUM(orders.total) as total_sum, MONTH(orders.delivery_date) as month')
            ->whereMonth('orders.delivery_date', Carbon::now()->month) // Lọc các đơn hàng của tháng hiện tại
            ->where('orders.status', 'completed') // Lọc các đơn hàng có status = 'completed'
            ->groupBy('orders.seller_id', 'month') // Group theo seller_id và tháng
            ->orderByDesc('total_sum') // Sắp xếp theo tổng doanh thu giảm dần
            ->with('seller') // Eager load quan hệ seller
            ->limit(5) // Lấy 5 cửa hàng có tổng doanh thu cao nhất
        )
        ->actions([
            // Các actions nếu cần thiết
        ])
        ->bulkActions([
            // Các bulk actions nếu cần thiết
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
