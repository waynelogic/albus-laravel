<?php

namespace Waynelogic\Emporium\Filament\Resources\Organizations;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Organizations\Pages\CreateOrganization;
use Waynelogic\Emporium\Filament\Resources\Organizations\Pages\EditOrganization;
use Waynelogic\Emporium\Filament\Resources\Organizations\Pages\ListOrganizations;
use Waynelogic\Emporium\Filament\Resources\Organizations\Schemas\OrganizationForm;
use Waynelogic\Emporium\Filament\Resources\Organizations\Tables\OrganizationsTable;
use Waynelogic\Emporium\Models\Organization;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class OrganizationResource extends SettingResource
{
    protected static ?string $model = Organization::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Организация';
    protected static ?string $pluralLabel = 'Организации';

    protected static string | null $description = 'Управление организациями';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedBuildingLibrary;
    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::BuildingLibrary;

    public static function form(Schema $schema): Schema
    {
        return OrganizationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationsTable::configure($table);
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
            'index' => ListOrganizations::route('/'),
            'create' => CreateOrganization::route('/create'),
            'edit' => EditOrganization::route('/{record}/edit'),
        ];
    }
}
