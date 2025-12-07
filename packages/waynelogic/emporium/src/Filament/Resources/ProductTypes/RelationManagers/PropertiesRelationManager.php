<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Enums\AttributeType;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\Emporium\Filament\Resources\Attributes\AttributeResource;
use Waynelogic\Emporium\Filament\Resources\Properties\PropertyResource;
use Waynelogic\Emporium\Models\Attribute;
use Waynelogic\Emporium\Models\Property;

class PropertiesRelationManager extends RelationManager
{
    protected static ?string $title = 'Свойства';

    protected static string $relationship = 'properties';

    protected static ?string $inverseRelationship = 'product_type_properties';

    protected static ?string $relatedResource = PropertyResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()->preloadRecordSelect()->schema(fn (AttachAction $action): array => [
                    $action->getRecordSelect()->afterStateUpdated(fn(string $operation, $state, Set $set) =>
                        $set('label', Property::find($state)->name)
                    )->live(onBlur: true),
                    TextInput::make('label')
                        ->label('Ярлык')
                        ->prefixIcon(Heroicon::OutlinedTag)
                        ->dehydrated()
                        ->required(),
                    Select::make('filter_type')
                        ->label('Тип фильтрации')
                        ->options(PropertyType::class),
                    Toggle::make('show_in_filter')
                        ->label('Показывать в фильтре?')
                        ->inline()
                        ->required(),
                    Toggle::make('is_required')
                        ->label('Обязательное?')
                        ->inline()
                        ->required(),
                ]),
            ])->recordActions([
                DetachAction::make(),
            ]);
    }
}
