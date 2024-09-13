<?php

namespace App\Filament\Resources\Product;

use App\Filament\Resources\Product\ProductResource\Pages;
use App\Filament\Resources\Product\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Markdown;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $navigationBadgeTooltip = 'Số lượng sản phẩm';

    protected static ?string $modelLabel = 'Sản phẩm';

    protected static ?int $navigationSort = 1; // vị trí hiển thị

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2) 
                ->schema([
                    Select::make('seller_id')
                    ->relationship('seller','store_name')
                    ->label('Tên cửa hàng')->disabled(),
                    Select::make('category_id')
                    ->relationship('category','name')
                    ->label('Tên danh mục')->disabled(),
                    Select::make('subcategory_id')
                    ->relationship('subcategory','name')
                    ->label('Tên danh mục con')->disabled(),
                    Select::make('brand_id')
                    ->relationship('brand','name')
                    ->label('Xuất xứ')->disabled(),
                    Textarea::make('description')->label('Mô tả sản phẩm')->disabled(),
                ]),
        
            Grid::make(2) 
                ->schema([
                    TextInput::make('price')->label('Giá')->disabled(),
                    TextInput::make('quantity')->label('Số lượng')->disabled(),
                    TextInput::make('favourite')->label('Lượt thích')->disabled(),
                    TextInput::make('rate')->label('Đánh giá')->disabled(),
                    TextInput::make('sale')->label('Lượt bán')->disabled(),
                ]),
            Grid::make(1)->schema([
                Select::make('status')
                ->options([
                    'Chờ phê duyệt' => 'Chờ phê duyệt',
                    'Đã phê duyệt' => 'Đã phê duyệt ',
                    'Từ chối' => 'Từ chối'
                ])
                ->label('Trạng thái'),
                ]),
            Grid::make(1)->schema([
                Select::make('note')->options([
                    'Sản phẩm đạt yêu cầu' => 'Sản phẩm đạt yêu cầu',
                    'Vi phạm chính sách về sản phẩm cấm' => 'Vi phạm chính sách về sản phẩm cấm',
                    'Thông tin sản phẩm không chính xác hoặc không rõ ràng' => 'Thông tin sản phẩm không chính xác hoặc không rõ ràng',
                    'Hình ảnh sản phẩm không đạt yêu cầu' => 'Hình ảnh sản phẩm không đạt yêu cầu',
                    'Sản phẩm vi phạm chính sách giá cả' => 'Sản phẩm vi phạm chính sách giá cả',
                    'Thiếu giấy tờ hợp lệ' => 'Thiếu giấy tờ hợp lệ',
                    'Sản phẩm bị sao chép hoặc trùng lặp' => 'Sản phẩm bị sao chép hoặc trùng lặp'
                ])->default('Sản phẩm đạt yêu cầu') 
            ])
           
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên')->sortable()->searchable(),
                TextColumn::make('seller.store_name')->label('Cửa hàng đăng sản phẩm')->sortable()->searchable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->sortable()
                    ->searchable()
                    ->icon(function ($state) {
                            switch ($state) {
                                case 'Chờ phê duyệt':
                                    return 'heroicon-o-clock'; 
                                case 'Đã phê duyệt':
                                    return 'heroicon-o-check-circle'; 
                                case 'Từ chối':
                                    return 'heroicon-o-x-circle'; 
                                default:
                                    return null;
                            }
                })
                ->formatStateUsing(function ($state) {
                    return $state;
                }),
                TextColumn::make('note')->label('Ghi chú')->sortable()->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Chi tiết sản phẩm'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
        return 'Quản lý sản phẩm'; 
    }

}
