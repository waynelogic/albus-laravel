<?php

namespace Waynelogic\Emporium\Filament\Resources\Warehouses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Warehouse;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Основное')->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->prefixIcon('heroicon-o-tag')
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                    ->required(),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->prefixIcon('heroicon-o-link')
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(Warehouse::class, 'slug', ignoreRecord: true),
            ])->columns(2)->columnSpanFull()->compact(),

            Textarea::make('description')
                ->label('Описание')
                ->columnSpanFull()
                ->maxLength(65535),
            TextInput::make('phone')
                ->label('Телефон')
                ->prefixIcon('heroicon-o-phone')
                ->maxLength(255),
            UuidInput::make(),
            ToggleDefault::make()
        ]);
    }
}
