<?php

namespace Waynelogic\Emporium\Filament\Resources\OrderStatuses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\Pages\CreateOrderStatus;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\Pages\EditOrderStatus;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\Pages\ListOrderStatuses;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\Schemas\OrderStatusForm;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\Tables\OrderStatusesTable;
use Waynelogic\Emporium\Models\OrderStatus;
use Waynelogic\FilamentCms\Filament\Settings\SettingsCluster;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class OrderStatusResource extends SettingResource
{
    protected static ?string $model = OrderStatus::class;

    protected static ?string $label = 'Статус заказа';

    protected static ?string $pluralLabel = 'Статусы заказов';

    protected static string | null $description = 'Управление статусами заказов';

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsUpDown;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::ArrowsUpDown;

    public static function form(Schema $schema): Schema
    {
        return OrderStatusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderStatusesTable::configure($table);
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
            'index' => ListOrderStatuses::route('/'),
            'create' => CreateOrderStatus::route('/create'),
            'edit' => EditOrderStatus::route('/{record}/edit'),
        ];
    }
}
