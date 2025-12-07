<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Models\PropertyGroup;

class PropertyGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Название')
                ->prefixIcon('heroicon-o-tag')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('handle', Str::slug($state)) : null),
            TextInput::make('handle')
                ->label('Handle')
                ->prefixIcon('heroicon-o-link')
                ->dehydrated()
                ->maxLength(255)
                ->unique(PropertyGroup::class, 'handle', ignoreRecord: true),
        ])->columns(2);
    }
}
