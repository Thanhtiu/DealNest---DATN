<?php

namespace App\Filament\Resources\TopProduct;

use App\Filament\Resources\TopProduct\TopProductResource\Pages;
use App\Filament\Resources\TopProduct\TopProductResource\RelationManagers;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class TopProductResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationGroup = 'Sản phẩm'; 

    protected static ?string $navigationBadgeTooltip = 'Số lượng sản phẩm';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Sản phẩm bán chạy';

    protected static ?string $modelLabel = 'Sản phẩm bán chạy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Cột tên sản phẩm
            Tables\Columns\TextColumn::make('product.name')
                ->label('Tên Sản Phẩm')
                ->sortable()
                ->searchable(),

            // Cột số lượng bán ra
            Tables\Columns\TextColumn::make('product_count')
                ->label('Số Lượng Bán')
                ->sortable()
                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),

            // Cột tháng (tháng hiện tại)
            Tables\Columns\TextColumn::make('month')
                ->label('Tháng')
                ->sortable()
                ->formatStateUsing(fn ($state) => 'Tháng ' . $state), // Hiển thị tháng với tiền tố "Tháng"
        ])
        ->query(fn (OrderItem $query) => $query->selectRaw('order_items.product_id, COUNT(*) as product_count, MONTH(order_items.created_at) as month')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereMonth('order_items.created_at', Carbon::now()->month) // Lọc các sản phẩm trong tháng hiện tại
            ->where('orders.status', 'completed') // Lọc các đơn hàng có status = 'completed'
            ->groupBy('order_items.product_id', 'month') // Group theo product_id và tháng
            ->orderByDesc('product_count') // Sắp xếp theo số lượng bán ra
            ->with('product') // Eager load quan hệ product
            ->limit(5) // Lấy 5 sản phẩm bán chạy nhất
        );
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
            'index' => Pages\ListTopProducts::route('/'),
           
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

 
}
