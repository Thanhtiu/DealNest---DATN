<?php

namespace App\Filament\Resources\SubCategory;

use App\Filament\Resources\SubCategory\SubCategoryResource\Pages;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class SubCategoryResource extends Resource
{
    protected static ?string $model = SubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Thể loại sản phẩm';

    protected static ?string $navigationBadgeTooltip = 'Số lượng sản phẩm';

    protected static ?string $modelLabel = 'Thể loại';

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
                        ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                            $set('slug', Str::slug($state));
                        })
                        ->label('Tên thể loại'),

                    TextInput::make('slug')
                        ->maxLength(255)
                        ->disabled()
                        ->required()
                        ->dehydrated()
                        ->unique(SubCategory::class, 'slug', ignoreRecord: true)
                        ->label('Tên định danh'),

                    Select::make('category_id')
                        ->label('Danh mục')
                        ->options(Category::all()->pluck('name', 'id')->toArray())
                        ->placeholder('Vui lòng chọn danh mục')
                        ->required(),

                    FileUpload::make('url')
                    ->label('Hình ảnh')
                    ->directory('subcategories'),

                    // Add this block for status
                    Toggle::make('status')
                    ->label('Hiển thị')
                    ->default(true)
                ]),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên thể loại')->sortable()->searchable(),
                TextColumn::make('slug')->label('Tên định danh')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Tên danh mục')->sortable()->searchable(),
                ImageColumn::make('url')->label('Hình ảnh'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
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
        return 'Quản lý thể loại'; 
    }
}