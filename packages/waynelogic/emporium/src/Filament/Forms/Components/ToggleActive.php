<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Filament\Forms\Components\Toggle;
class ToggleActive extends Toggle
{
    public static function make(string|null $name = 'is_active'): static
    {
        return parent::make($name)
            ->label('Активность')
            ->onIcon('heroicon-s-power')
            ->default(true);
    }
}
