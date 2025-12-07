<?php

namespace Waynelogic\Emporium\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Property;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Основное')->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->prefixIcon('heroicon-o-tag')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('handle', Str::slug($state)) : null),
                TextInput::make('handle')
                    ->label('Слаг')
                    ->prefixIcon('heroicon-o-link')
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(Property::class, 'handle', ignoreRecord: true),
                Select::make('property_group_id')
                    ->label('Группа атрибутов')
                    ->prefixIcon('heroicon-o-square-3-stack-3d')
                    ->relationship(name: 'property_group', titleAttribute: 'name', modifyQueryUsing: function (Builder $query) use ($schema) {
                        if (isset($schema->model->holder_class)) {
                            return $query->where('holder_class', $schema->model->holder_class);
                        } else {
                            return $query;
                        }
                    })
                    ->native(false)
                    ->required(),

                Select::make('type')
                    ->label('Тип')
                    ->prefixIcon('heroicon-o-archive-box')
                    ->live(onBlur: true)
                    ->native(false)
                    ->options(PropertyType::class)
                    ->required(),

                Select::make('unit_id')
                    ->label('Единица измерения')
                    ->relationship('unit', 'name')
                    ->prefixIcon('heroicon-o-scale')
                    ->preload()
                    ->searchable(),

                UuidInput::make(),

                TextInput::make('section')
                    ->label('Секция')
                    ->datalist(Property::pluck('section')->unique()->toArray()),

                Toggle::make('is_required')
                    ->label('Обязательный?')
                    ->onIcon(Heroicon::OutlinedQuestionMarkCircle)
                    ->required(),
            ])->columns(2)->columnSpanFull(),
        ]);
    }
}
