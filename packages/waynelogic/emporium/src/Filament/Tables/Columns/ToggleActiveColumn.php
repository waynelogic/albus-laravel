<?php

namespace Waynelogic\Emporium\Filament\Tables\Columns;

use Filament\Tables\Columns\ToggleColumn;
class ToggleActiveColumn extends ToggleColumn
{
    public static function make(?string $name = 'is_active'): static
    {
        return parent::make($name)
            ->label('Активен');
    }
}
