<?php

namespace Waynelogic\Emporium\Filament\Resources\Taxes;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Taxes\Pages\CreateTax;
use Waynelogic\Emporium\Filament\Resources\Taxes\Pages\EditTax;
use Waynelogic\Emporium\Filament\Resources\Taxes\Pages\ListTaxes;
use Waynelogic\Emporium\Filament\Resources\Taxes\Schemas\TaxForm;
use Waynelogic\Emporium\Filament\Resources\Taxes\Tables\TaxesTable;
use Waynelogic\Emporium\Models\Tax;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class TaxResource extends SettingResource
{
    protected static ?string $model = Tax::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Налог';
    protected static ?string $pluralLabel = 'Налоги';
    protected static string | null $description = 'Управление налогами';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedReceiptPercent;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::ReceiptPercent;

    public static function form(Schema $schema): Schema
    {
        return TaxForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxesTable::configure($table);
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
            'index' => ListTaxes::route('/'),
            'create' => CreateTax::route('/create'),
            'edit' => EditTax::route('/{record}/edit'),
        ];
    }
}
