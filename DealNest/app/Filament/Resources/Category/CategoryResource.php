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
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Danh mục sản phẩm';

    protected static ?string $navigationBadgeTooltip = 'Số lượng danh mục';

    protected static ?string $modelLabel = 'Danh mục';

    protected static ?int $navigationSort = 1; // vị trí hiển thị

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
                        ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set, Forms\Get $get) {
                            $set('slug', Str::slug($state));
                        })
                        ->unique(Category::class,'slug', ignoreRecord:true)
                        ->label('Tên danh mục'),
        
                    FileUpload::make('url')
                        ->label('Hình ảnh')
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên danh mục')->sortable()->searchable(),
                TextColumn::make('slug')->label('Đường dẫn')->sortable()->searchable(),
                ImageColumn::make('url')->label('Hình ảnh'),
                
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
        return static::getModel()::count() > 10 ? 'primary' : 'warning';
    }

    public static function getBreadcrumb(): string
    {
        return 'Quản lý danh mục'; 
    }

}