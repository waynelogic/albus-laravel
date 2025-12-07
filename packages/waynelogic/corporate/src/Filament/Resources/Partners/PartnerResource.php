<?php

namespace Waynelogic\Corporate\Filament\Resources\Partners;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Corporate\Filament\Resources\Partners\Pages\CreatePartner;
use Waynelogic\Corporate\Filament\Resources\Partners\Pages\EditPartner;
use Waynelogic\Corporate\Filament\Resources\Partners\Pages\ListPartners;
use Waynelogic\Corporate\Filament\Resources\Partners\Schemas\PartnerForm;
use Waynelogic\Corporate\Filament\Resources\Partners\Tables\PartnersTable;
use Waynelogic\Corporate\Models\Partner;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $label = 'Партнер';

    protected static ?string $pluralLabel = 'Партнеры';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::BuildingOffice2;

    public static function form(Schema $schema): Schema
    {
        return PartnerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnersTable::configure($table);
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
            'index' => ListPartners::route('/'),
            'create' => CreatePartner::route('/create'),
            'edit' => EditPartner::route('/{record}/edit'),
        ];
    }
}
