<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\Pages\CreateProductType;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\Pages\EditProductType;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\Pages\ListProductTypes;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\RelationManagers\OptionsRelationManager;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\RelationManagers\ProductsRelationManager;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\RelationManagers\PropertiesRelationManager;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\Schemas\ProductTypeForm;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\Tables\ProductTypesTable;
use Waynelogic\Emporium\Models\ProductType;

class ProductTypeResource extends Resource
{
    protected static ?string $model = ProductType::class;

    protected static ?string $navigationParentItem = 'Товары';

    protected static ?string $label = 'Вид товара';

    protected static ?string $pluralLabel = 'Виды товаров';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = 'Каталог';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::CircleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
            PropertiesRelationManager::class,
            OptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductTypes::route('/'),
            'create' => CreateProductType::route('/create'),
            'edit' => EditProductType::route('/{record}/edit'),
        ];
    }
}
