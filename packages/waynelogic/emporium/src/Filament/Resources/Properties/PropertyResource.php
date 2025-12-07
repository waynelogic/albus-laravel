<?php

namespace Waynelogic\Emporium\Filament\Resources\Properties;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Properties\Pages\CreateProperty;
use Waynelogic\Emporium\Filament\Resources\Properties\Pages\EditProperty;
use Waynelogic\Emporium\Filament\Resources\Properties\Pages\ListProperties;
use Waynelogic\Emporium\Filament\Resources\Properties\Schemas\PropertyForm;
use Waynelogic\Emporium\Filament\Resources\Properties\Tables\PropertiesTable;
use Waynelogic\Emporium\Filament\Resources\Properties\RelationManagers\ValuesRelationManager;
use Waynelogic\Emporium\Models\Property;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';
    protected static ?string $label = 'Свойство';
    protected static ?string $pluralLabel = 'Свойства';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::AdjustmentsHorizontal;

    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ValuesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
