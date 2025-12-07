<?php

namespace Waynelogic\Emporium\Filament\Resources\PriceTypes;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\Pages\CreatePriceType;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\Pages\EditPriceType;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\Pages\ListPriceTypes;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\Schemas\PriceTypeForm;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\Tables\PriceTypesTable;
use Waynelogic\Emporium\Models\PriceType;
use Waynelogic\FilamentCms\System\Filament\SettingResource;

class PriceTypeResource extends SettingResource
{
    protected static ?string $model = PriceType::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Справочники магазина';

    protected static ?string $label = 'Тип цены';

    protected static ?string $pluralLabel = 'Типы цен';

    protected static string | null $description = 'Управление типами цен';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedArrowUpOnSquareStack;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::ArrowUpOnSquareStack;


    public static function form(Schema $schema): Schema
    {
        return PriceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PriceTypesTable::configure($table);
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
            'index' => ListPriceTypes::route('/'),
            'create' => CreatePriceType::route('/create'),
            'edit' => EditPriceType::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
