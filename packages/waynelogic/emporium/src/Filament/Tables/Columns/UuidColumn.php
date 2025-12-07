<?php

namespace Waynelogic\Emporium\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class UuidColumn extends TextColumn
{
    public static function make(?string $name = 'external_id', ?bool $hidden = true): static
    {
        return parent::make($name)
            ->label('Внешний ID')
            ->sortable()
            ->searchable()
            ->toggleable(isToggledHiddenByDefault: $hidden);
    }
}
