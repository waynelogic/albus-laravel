<?php

namespace Waynelogic\Emporium\Filament\Resources\Countries;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Countries\Pages\CreateCountry;
use Waynelogic\Emporium\Filament\Resources\Countries\Pages\EditCountry;
use Waynelogic\Emporium\Filament\Resources\Countries\Pages\ListCountries;
use Waynelogic\Emporium\Filament\Resources\Countries\Schemas\CountryForm;
use Waynelogic\Emporium\Filament\Resources\Countries\Tables\CountriesTable;
use Waynelogic\Emporium\Models\Country;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class CountryResource extends SettingResource
{
    protected static ?string $model = Country::class;


    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Страна';
    protected static ?string $pluralLabel = 'Страны';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::RectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
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
            'index' => ListCountries::route('/'),
            'create' => CreateCountry::route('/create'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
