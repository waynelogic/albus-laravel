<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Support\Icons\Heroicon;

class DeliveryForm extends Group
{
    public static function make(array|Closure $schema = []): static
    {
        return parent::make([
//            Fieldset::make()->action

            Select::make('dimension_unit_id')
                ->label('Единица измерения размера')
                ->prefixIcon(Heroicon::OutlinedCalculator)
                ->relationship('dimension_unit', 'name')
                ->native(false),
            Select::make('weight_unit_id')
                ->label('Единица измерения веса')
                ->prefixIcon(Heroicon::OutlinedArrowUp)
                ->relationship('weight_unit', 'name')
                ->native(false),
            TextInput::make('weight')
                ->label('Вес')
                ->prefixIcon(Heroicon::OutlinedScale)
                ->numeric(),
            TextInput::make('length')
                ->label('Длина')
                ->prefixIcon(Heroicon::OutlinedArrowUpRight)
                ->numeric(),
            TextInput::make('width')
                ->label('Ширина')
                ->prefixIcon(Heroicon::OutlinedArrowRight)
                ->numeric(),
            TextInput::make('height')
                ->label('Высота')
                ->prefixIcon(Heroicon::OutlinedArrowUp)
                ->numeric(),
        ])->columns(2);
    }
}
