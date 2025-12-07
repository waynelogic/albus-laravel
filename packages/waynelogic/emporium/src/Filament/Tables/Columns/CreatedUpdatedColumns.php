<?php

namespace Waynelogic\Emporium\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CreatedUpdatedColumns
{
    public static function make($created_at_hidden = true, $updated_at_hidden = true): array
    {
        return [
            TextColumn::make('created_at')
                ->label('Дата создания')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $created_at_hidden),
            TextColumn::make('updated_at')
                ->label('Дата обновления')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $updated_at_hidden),
        ];
    }
}
