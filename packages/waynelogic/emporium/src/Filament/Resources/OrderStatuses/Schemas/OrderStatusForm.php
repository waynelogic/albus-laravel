<?php

namespace Waynelogic\Emporium\Filament\Resources\OrderStatuses\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Models\OrderStatus;

class OrderStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Основное')->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon('heroicon-o-tag')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('code', Str::slug($state)) : null),
                    TextInput::make('code')
                        ->label('Код')
                        ->prefixIcon('heroicon-o-link')
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(OrderStatus::class, 'code', ignoreRecord: true),
                ])->columnSpanFull()->columns(2),

                ColorPicker::make('color'),
                TextInput::make('icon'),
                TextInput::make('description'),
                Toggle::make('is_cancel')
                    ->required(),
                Toggle::make('is_complete')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_default')
                    ->required(),
            ]);
    }
}
