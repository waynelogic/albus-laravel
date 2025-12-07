<?php

namespace Waynelogic\Emporium\Filament\Resources\PriceTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;

class PriceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Наименование')
                ->prefixIcon('heroicon-o-tag')
                ->required(),
            Select::make('currency_id')
                ->label('Валюта')
                ->relationship('currency', 'name')
                ->native(false),
            TextInput::make('code')
                ->label('Код')
                ->prefixIcon('heroicon-o-qr-code'),
            UuidInput::make(),

            Fieldset::make('Дополнительно')->schema([
                ToggleActive::make(),
                ToggleDefault::make(),
            ])->columns(2),
        ]);
    }
}
