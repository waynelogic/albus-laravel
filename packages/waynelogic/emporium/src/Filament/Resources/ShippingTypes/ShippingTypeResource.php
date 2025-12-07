<?php

namespace Waynelogic\Emporium\Filament\Resources\ShippingTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\Pages\CreateShippingType;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\Pages\EditShippingType;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\Pages\ListShippingTypes;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\Schemas\ShippingTypeForm;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\Tables\ShippingTypesTable;
use Waynelogic\Emporium\Models\ShippingType;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class ShippingTypeResource extends SettingResource
{
    protected static ?string $model = ShippingType::class;

    protected static ?string $label = 'Метод доставки';

    protected static ?string $pluralLabel = 'Методы доставки';

    protected static string | null $description = 'Управление cпоcобами доставки';

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::Truck;

    public static function form(Schema $schema): Schema
    {
        return ShippingTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingTypesTable::configure($table);
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
            'index' => ListShippingTypes::route('/'),
            'create' => CreateShippingType::route('/create'),
            'edit' => EditShippingType::route('/{record}/edit'),
        ];
    }
}
