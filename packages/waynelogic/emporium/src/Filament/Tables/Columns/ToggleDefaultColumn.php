<?php

namespace Waynelogic\Emporium\Filament\Tables\Columns;

use Filament\Tables\Columns\ToggleColumn;
class ToggleDefaultColumn extends ToggleColumn
{
    public static function make(?string $name = 'is_default'): static
    {
        return parent::make($name)
            ->label('По умолчанию');
    }
}
