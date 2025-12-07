<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Offers\Pages\CreateOffer;
use Waynelogic\Emporium\Filament\Resources\Offers\Pages\EditOffer;
use Waynelogic\Emporium\Filament\Resources\Offers\Pages\ListOffers;
use Waynelogic\Emporium\Filament\Resources\Offers\Pages\PriceList;
use Waynelogic\Emporium\Filament\Resources\Offers\Schemas\OfferForm;
use Waynelogic\Emporium\Filament\Resources\Offers\Tables\OffersTable;
use Waynelogic\Emporium\Filament\Resources\Products\ProductResource;
use Waynelogic\Emporium\Models\Offer;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $label = 'Предложение';

    protected static ?string $pluralLabel = 'Предложения';

    protected static ?string $recordTitleAttribute = 'name';

//    protected static ?string $parentResource = ProductResource::class;

    protected static string | UnitEnum | null $navigationGroup = 'Каталог';

    protected static bool $shouldRegisterNavigation = true;

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedBookmarkSquare;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::BookmarkSquare;

    public static function form(Schema $schema): Schema
    {
        return OfferForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OffersTable::configure($table);
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
            'index' => ListOffers::route('/'),
            'price-list' => PriceList::route('/price-list'),
            'create' => CreateOffer::route('/create'),
            'edit' => EditOffer::route('/{record}/edit'),
        ];
    }
}
