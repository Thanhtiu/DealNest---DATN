<?php

namespace App\Filament\Resources\Product;

use App\Filament\Resources\Product\ProductResource\Pages;
use App\Filament\Resources\Product\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Markdown;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\Action;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Danh sách sản phẩm';

    protected static ?string $navigationGroup = 'Sản phẩm'; 


    protected static ?string $navigationBadgeTooltip = 'Số lượng sản phẩm';

    protected static ?string $modelLabel = 'Sản phẩm';

    protected static ?int $navigationSort = 1; // vị trí hiển thị

    public static function form(Form $form): Form
    {
        $record = $form->getRecord(); // Lấy record của đối tượng hiện tại

        $imageUrl = $record && $record->image 
        ? asset('uploads/' . $record->image) // Tính toán đường dẫn ảnh nếu có
        : null; // Nếu không có ảnh thì là null

        $productImages = $record ? $record->product_image->map(function($image) {
            return asset('uploads/' . $image->image);  // Tính toán đường dẫn ảnh phụ
        }) : []; 

        return $form
        ->schema([
            Grid::make(2) 
                ->schema([
                    TextInput::make('name')->disabled(),
                    Select::make('seller_id')
                    ->relationship('seller','name')
                    ->label('Tên cửa hàng')->disabled(),
                    Select::make('category_id')
                    ->relationship('category','name')
                    ->label('Tên danh mục')->disabled(),

                    ViewField::make('image_preview')
                    ->label('Hình ảnh')
                    ->view('components.image-preview', [
                        'image' => $imageUrl // Truyền giá trị ảnh vào view
                    ]),

                      // Hiển thị tất cả ảnh của sản phẩm
                    ViewField::make('image_preview')
                    ->label('Ảnh phụ')
                    ->view('components.image-preview', [
                        'images' => $productImages // Truyền tất cả ảnh vào view
                    ]),

                    

                    Textarea::make('description')
                    ->label('Mô tả sản phẩm')
                    ->disabled()
                    ->afterStateHydrated(function (Textarea $component, $state) {
                        $component->state(strip_tags($state)); // Loại bỏ HTML
                    })
                    ->extraAttributes([
                        'class' => 'w-full', // Cho phép chiều rộng đầy đủ
                        'style' => 'height: 200px;' // Đặt chiều cao trực tiếp bằng style
                    ])
                
                    
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
                    'pending' => 'Chờ phê duyệt',
                    'approved' => 'Đã phê duyệt ',
                    'cancel' => 'Từ chối'
                ])
                ->placeholder('Chọn trạng thái')
                ->label('Trạng thái'),
                ]),
            Grid::make(1)->schema([
                Select::make('note')
                ->options([
                    'Sản phẩm đạt yêu cầu' => 'Sản phẩm đạt yêu cầu',
                    'Vi phạm chính sách về sản phẩm cấm' => 'Vi phạm chính sách về sản phẩm cấm',
                    'Thông tin sản phẩm không chính xác hoặc không rõ ràng' => 'Thông tin sản phẩm không chính xác hoặc không rõ ràng',
                    'Hình ảnh sản phẩm không đạt yêu cầu' => 'Hình ảnh sản phẩm không đạt yêu cầu',
                    'Sản phẩm vi phạm chính sách giá cả' => 'Sản phẩm vi phạm chính sách giá cả',
                    'Thiếu giấy tờ hợp lệ' => 'Thiếu giấy tờ hợp lệ',
                    'Sản phẩm bị sao chép hoặc trùng lặp' => 'Sản phẩm bị sao chép hoặc trùng lặp'
                ])
                ->placeholder('Chọn lý do')
                ->label('Ghi chú')
            ])
           
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên')->sortable()->searchable()->limit(20),
                TextColumn::make('seller.name')->label('Cửa hàng')->sortable()->searchable(),

            
                ImageColumn::make('image')
                ->label('Hình ảnh')
                ->disk('uploads') // Đảm bảo sử dụng đúng disk
                ->url(fn ($record) => Storage::disk('uploads')->url($record->image)) // Tạo đường dẫn URL
                ->width(100)
                ->height(100),


                
                TextColumn::make('status')
                ->label('Trạng thái')
                ->sortable()
                ->searchable()
                ->icon(fn ($state) => match ($state) {
                    'pending' => 'heroicon-o-clock',
                    'approved' => 'heroicon-o-check-circle',
                    'cancel' => 'heroicon-o-x-circle',
                    default => null,
                })
                ->color(fn ($state) => match ($state) {
                    'pending' => 'primary', // Màu vàng cho pending
                    'approved' => 'success', // Màu xanh cho approved
                    'cancel' => 'danger',     // Màu đỏ cho cancel
                    default => 'gray',     // Màu xám mặc định
                })
                ->formatStateUsing(fn ($state) => match ($state) {
                    'pending' => 'Đang chờ',
                    'approved' => 'Đã duyệt',
                    'cancel' => 'Đã hủy',
                    default => $state,
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
                Tables\Actions\EditAction::make()->label('Chi tiết'),

                Action::make('Approve')
                ->label(fn (Product $record) => match ($record->status) {
                    'pending' => 'Duyệt',
                    'approved' => 'Đã phê duyệt',
                    'cancel' => 'Đã từ chối',
                })
                ->icon(fn (Product $record) => match ($record->status) {
                    'pending' => 'heroicon-o-check',
                    'approved' => 'heroicon-o-badge-check',
            'cancel' => 'heroicon-o-x-circle',
                })
                ->action(function (Product $record) {
                    // Cập nhật trạng thái thành 'approved'
                    $record->status = 'approved';
                    $record->save();
                })
                ->color(fn (Product $record) => match ($record->status) {
                    'pending' => 'success',
                    'approved' => 'gray',
                    'cancel' => 'danger',
                })
                ->visible(fn (Product $record) => $record->status === 'pending') // Chỉ hiện nếu là pending
                ->disabled(fn (Product $record) => $record->status !== 'pending'),

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
