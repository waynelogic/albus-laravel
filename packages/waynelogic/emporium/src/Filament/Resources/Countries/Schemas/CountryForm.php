<?php

namespace Waynelogic\Emporium\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Название')
                ->prefixIcon(Heroicon::OutlinedTag)
                ->required(),
            Select::make('currency_id')
                ->label('Валюта')
                ->prefixIcon(Heroicon::OutlinedCurrencyDollar)
                ->relationship('currency', 'name'),
            TextInput::make('iso')
                ->label('Код')
                ->prefixIcon(Heroicon::OutlinedCodeBracket),
            TextInput::make('phone_code')
                ->label('Код телефона')
                ->prefixIcon(Heroicon::OutlinedPhone),
            TextInput::make('capital')
                ->label('Столица')
                ->prefixIcon(Heroicon::OutlinedGlobeEuropeAfrica),
            TextInput::make('lang')
                ->label('Язык')
                ->prefixIcon(Heroicon::OutlinedGlobeAlt),
        ]);
    }
}
