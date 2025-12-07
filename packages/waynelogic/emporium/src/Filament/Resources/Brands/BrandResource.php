<?php

namespace Waynelogic\Emporium\Filament\Resources\Brands;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Brands\Pages\CreateBrand;
use Waynelogic\Emporium\Filament\Resources\Brands\Pages\EditBrand;
use Waynelogic\Emporium\Filament\Resources\Brands\Pages\ListBrands;
use Waynelogic\Emporium\Filament\Resources\Brands\Schemas\BrandForm;
use Waynelogic\Emporium\Filament\Resources\Brands\Tables\BrandsTable;
use Waynelogic\Emporium\Models\Brand;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $label = 'Бренд';

    protected static ?string $pluralLabel = 'Бренды';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = 'Каталог';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedBookmarkSquare;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::BookmarkSquare;

    public static function form(Schema $schema): Schema
    {
        return BrandForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrandsTable::configure($table);
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
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
