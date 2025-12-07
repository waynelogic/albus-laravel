<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;
class UuidInput extends TextInput
{
    public static function make(string|null $name = 'external_id'): static
    {
        return parent::make($name)
            ->label('Внешний идентификатор')
            ->prefixIcon('heroicon-o-clipboard')
            ->mask('********-****-****-****-************');
    }
}
