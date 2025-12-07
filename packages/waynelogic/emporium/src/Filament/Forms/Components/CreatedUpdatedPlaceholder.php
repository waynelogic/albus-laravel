<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Closure;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Illuminate\Contracts\Support\Htmlable;
use Waynelogic\Emporium\Models\Brand;

class CreatedUpdatedPlaceholder extends Section
{
    public static function make(Htmlable|array|Closure|string|null $heading = null): static
    {
        return parent::make($heading)->schema([
            TextEntry::make('created_at')
                ->label('Дата создания')
                ->state(fn ($record): ?string => $record->created_at?->diffForHumans()),
            TextEntry::make('updated_at')
                ->label('Дата изменения')
                ->state(fn ($record): ?string => $record->updated_at?->diffForHumans()),
        ])->columnSpan(['lg' => 1])->hidden(fn ($record) => $record === null);
    }
}
