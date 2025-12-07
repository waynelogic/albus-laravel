<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\Pages\CreatePropertyGroup;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\Pages\EditPropertyGroup;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\Pages\ListPropertyGroups;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\RelationManagers\PropertiesRelationManager;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\Schemas\PropertyGroupForm;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\Tables\PropertyGroupsTable;
use Waynelogic\Emporium\Models\PropertyGroup;

class PropertyGroupResource extends Resource
{
    protected static ?string $model = PropertyGroup::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Группа свойств';
    protected static ?string $pluralLabel = 'Группы свойств';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedSquare3Stack3d;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::Square3Stack3d;

    public static function form(Schema $schema): Schema
    {
        return PropertyGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertyGroupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PropertiesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyGroups::route('/'),
            'create' => CreatePropertyGroup::route('/create'),
            'edit' => EditPropertyGroup::route('/{record}/edit'),
        ];
    }
}
