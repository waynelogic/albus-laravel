<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Filament\Forms\Components\Toggle;

class ToggleDefault extends Toggle
{
    public static function make(string|null $name = 'is_default'): static
    {
        return parent::make($name)
            ->label('По умолчанию')
            ->onIcon('heroicon-s-power')
            ->default(false);
    }
}
