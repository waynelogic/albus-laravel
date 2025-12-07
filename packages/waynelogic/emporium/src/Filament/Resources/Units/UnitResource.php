<?php

namespace Waynelogic\Emporium\Filament\Resources\Units;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Units\Pages\CreateUnit;
use Waynelogic\Emporium\Filament\Resources\Units\Pages\EditUnit;
use Waynelogic\Emporium\Filament\Resources\Units\Pages\ListUnits;
use Waynelogic\Emporium\Filament\Resources\Units\Pages\ViewUnit;
use Waynelogic\Emporium\Filament\Resources\Units\Schemas\UnitForm;
use Waynelogic\Emporium\Filament\Resources\Units\Schemas\UnitInfolist;
use Waynelogic\Emporium\Filament\Resources\Units\Tables\UnitsTable;
use Waynelogic\Emporium\Models\Unit;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class UnitResource extends SettingResource
{
    protected static ?string $model = Unit::class;
    protected static string | UnitEnum | null $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Единица измерения';
    protected static ?string $pluralLabel = 'Единицы измерения';
    protected static string | null $description = 'Управление единицами измерения';
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedScale;
    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::Scale;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UnitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UnitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table);
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
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'view' => ViewUnit::route('/{record}'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }
}
