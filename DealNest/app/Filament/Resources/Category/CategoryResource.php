<?php

namespace App\Filament\Resources\Category;

use App\Filament\Resources\Category\CategoryResource\Pages;
use App\Filament\Resources\Category\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Notifications\Notification;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Danh mục sản phẩm';

    protected static ?string $navigationBadgeTooltip = 'Số lượng danh mục';

    protected static ?string $modelLabel = 'Danh mục';

    protected static ?int $navigationSort = 2; // vị trí hiển thị

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2)
                ->schema([
                    TextInput::make('name')
    ->maxLength(255)
    ->required()
    ->live(onBlur: true)
    ->afterStateUpdated(function (string $operation, ?string $state, Forms\Set $set, Forms\Get $get) {
        if ($state !== null) { // Kiểm tra nếu $state không rỗng
            $set('slug', Str::slug($state));
        }
    })
    ->unique(Category::class, 'slug', ignoreRecord: true)
    ->label('Tên danh mục'),
    
                    FileUpload::make('image')
                        ->label('Hình ảnh')
                        ->required()
                        ->directory('categories'),
                ]),
    
            Grid::make(2)
                ->schema([
                    TextInput::make('slug')
                        ->maxLength(255)
                        ->disabled()
                        ->required()
                        ->dehydrated()
                        ->unique(Category::class, 'slug', ignoreRecord: true)
                        ->label('Tên định danh'),
    
                    Toggle::make('status')
                        ->label('Hiển thị')
                        ->default(true),
                ]),
    
                Select::make('parent_id')
                ->label('Danh mục cha')
                ->options(['0' => 'Danh mục lớn nhất'] + Category::all()->pluck('name', 'id')->toArray())
                ->searchable()
                ->placeholder('Chọn danh mục cha')
                ->required()
                ->default(0), // Đặt giá trị mặc định là 0 
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên danh mục')->sortable()->searchable(),
                TextColumn::make('slug')->label('Đường dẫn')->sortable()->searchable(),
                ImageColumn::make('image')->label('Hình ảnh'),
                TextColumn::make('parent.name')
                ->label('Danh mục cha')
                ->sortable()
                ->searchable()
                ->getStateUsing(function ($record) {
                    return $record->parent ? $record->parent->name : 'Danh mục lớn nhất'; // Nếu không có danh mục cha, hiển thị "Danh mục lớn nhất"
                }),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
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
        return 'Quản lý danh mục'; 
    }
    

}