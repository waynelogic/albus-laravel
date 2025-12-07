<?php namespace Waynelogic\Emporium\Filament\Resources\Currencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([

                Fieldset::make('Данные')->schema([
                    TextInput::make('name')
                        ->label('Наименование')
                        ->prefixIcon('heroicon-o-tag')
                        ->columnSpanFull()
                        ->required(),
                    TextInput::make('code')
                        ->label('Код')
                        ->prefixIcon('heroicon-o-code-bracket-square')
                        ->required(),
                    TextInput::make('number')
                        ->label('Номер')
                        ->prefixIcon('heroicon-o-numbered-list')
                        ->numeric()
                        ->required(),
                    TextInput::make('symbol')
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->label('Символ'),
                    TextInput::make('rate')
                        ->label('Курс')
                        ->prefixIcon('heroicon-o-chart-bar-square')
                        ->numeric()
                        ->required(),
                ]),

            ])->columnSpan(['lg' => 2]),

            Group::make([
                Fieldset::make('Дополнительно')->schema([
                    UuidInput::make(),
                    ToggleActive::make(),
                    ToggleDefault::make(),
                ])->columns(1)
            ]),

        ])->columns(['lg' => 3]);
    }
}
