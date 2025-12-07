<?php

namespace Waynelogic\Emporium\Filament\Resources\Taxes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;

class TaxForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([
                TextInput::make('name')
                    ->label('Название')
                    ->prefixIcon('heroicon-o-tag')
                    ->required(),
                TextInput::make('percent')
                    ->label('Процент')
                    ->numeric()
                    ->prefixIcon('heroicon-o-receipt-percent')
                    ->suffix('%')
                    ->required(),
                Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
            ])->columnSpan(['lg' => 2])->columns(2),

            Group::make([
                Section::make('Статусы')->schema([
                    Toggle::make('is_global')
                        ->label('Глобальный'),
                    ToggleActive::make(),
                    ToggleDefault::make(),
                ]),
            ]),

        ])->columns(['lg' => 3]);
    }
}
