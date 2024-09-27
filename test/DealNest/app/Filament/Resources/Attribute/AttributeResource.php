<?php

namespace App\Filament\Resources\Attribute;

use App\Filament\Resources\Attribute\AttributeResource\Pages;
use App\Filament\Resources\Attribute\AttributeResource\RelationManagers;
use App\Models\Attribute;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Thuộc tính sản phẩm';

    protected static ?string $navigationBadgeTooltip = 'Số lượng thuộc tính';

    protected static ?string $modelLabel = 'Thuộc tính sản phẩm';

    protected static ?int $navigationSort = 4; // vị trí hiển thị


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2) 
                ->schema([
                    TextInput::make('name')
                        ->maxLength(255)
                        ->required()
                        ->unique(Attribute::class,'name', ignoreRecord:true)
                        ->label('Tên thuộc tính'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên thuộc tính')->sortable()->searchable(),
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
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
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
        return 'Quản lý thuộc tính'; 
    }

}
