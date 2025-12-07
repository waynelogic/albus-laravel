<?php

namespace Waynelogic\Emporium\Filament\Resources\Products;

use BackedEnum;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Products\Pages\CreateProduct;
use Waynelogic\Emporium\Filament\Resources\Products\Pages\EditProduct;
use Waynelogic\Emporium\Filament\Resources\Products\Pages\ListProducts;
use Waynelogic\Emporium\Filament\Resources\Products\RelationManagers\AssociationsRelationManager;
use Waynelogic\Emporium\Filament\Resources\Products\RelationManagers\OffersRelationManager;
use Waynelogic\Emporium\Filament\Resources\Products\RelationManagers\ProductPropertiesRelationManager;
use Waynelogic\Emporium\Filament\Resources\Products\Schemas\ProductForm;
use Waynelogic\Emporium\Filament\Resources\Products\Tables\ProductsTable;
use Waynelogic\Emporium\Models\Product;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $label = 'Товар';

    protected static ?string $pluralLabel = 'Товары';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = 'Каталог';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::Squares2x2;

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OffersRelationManager::class,
            AssociationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
//            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
