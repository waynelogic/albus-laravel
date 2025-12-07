<?php

namespace Waynelogic\Emporium\Filament\Resources\Currencies;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Currencies\Pages\CreateCurrency;
use Waynelogic\Emporium\Filament\Resources\Currencies\Pages\EditCurrency;
use Waynelogic\Emporium\Filament\Resources\Currencies\Pages\ListCurrencies;
use Waynelogic\Emporium\Filament\Resources\Currencies\Schemas\CurrencyForm;
use Waynelogic\Emporium\Filament\Resources\Currencies\Tables\CurrenciesTable;
use Waynelogic\Emporium\Models\Currency;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class CurrencyResource extends SettingResource
{
    protected static ?string $model = Currency::class;

    protected static string | UnitEnum | null $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Валюта';
    protected static ?string $pluralLabel = 'Валюты';

    protected static string | null $description = 'Управление валютами';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::CurrencyDollar;

    public static function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrenciesTable::configure($table);
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
            'index' => ListCurrencies::route('/'),
            'create' => CreateCurrency::route('/create'),
            'edit' => EditCurrency::route('/{record}/edit'),
        ];
    }
}
