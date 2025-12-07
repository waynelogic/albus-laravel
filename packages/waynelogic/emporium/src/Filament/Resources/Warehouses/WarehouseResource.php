<?php

namespace Waynelogic\Emporium\Filament\Resources\Warehouses;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Warehouses\Pages\CreateWarehouse;
use Waynelogic\Emporium\Filament\Resources\Warehouses\Pages\EditWarehouse;
use Waynelogic\Emporium\Filament\Resources\Warehouses\Pages\ListWarehouses;
use Waynelogic\Emporium\Filament\Resources\Warehouses\Schemas\WarehouseForm;
use Waynelogic\Emporium\Filament\Resources\Warehouses\Tables\WarehousesTable;
use Waynelogic\Emporium\Models\Warehouse;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class WarehouseResource extends SettingResource
{
    protected static ?string $model = Warehouse::class;


    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';
    protected static ?string $label = 'Склад';
    protected static ?string $pluralLabel = 'Склады';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedInboxStack;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::InboxStack;

    public static function form(Schema $schema): Schema
    {
        return WarehouseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarehousesTable::configure($table);
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
            'index' => ListWarehouses::route('/'),
            'create' => CreateWarehouse::route('/create'),
            'edit' => EditWarehouse::route('/{record}/edit'),
        ];
    }
}
