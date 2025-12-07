<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Enums\AttributeType;
use Waynelogic\Emporium\Filament\Resources\Attributes\AttributeResource;
use Waynelogic\Emporium\Filament\Resources\Properties\PropertyResource;

class OptionsRelationManager extends RelationManager
{
    protected static ?string $title = 'Опции';

    protected static string $relationship = 'options';
    protected static ?string $inverseRelationship = 'product_types_options';
    protected static ?string $relatedResource = PropertyResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()->preloadRecordSelect()->schema(fn (AttachAction $action): array => [
                    $action->getRecordSelect(),
                    TextInput::make('label')
                        ->label('Ярлык')
                        ->prefixIcon(Heroicon::OutlinedTag)
                        ->required(),
                    Select::make('filter_type')
                        ->label('Тип фильтрации')
                        ->options(AttributeType::class),
                    Toggle::make('show_in_filter')
                        ->label('Показывать в фильтре?')
                        ->inline()
                        ->required(),
                    Toggle::make('is_required')
                        ->label('Обязательное?')
                        ->inline()
                        ->required(),
                ]),
            ]);
    }
}
