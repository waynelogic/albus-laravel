<?php

namespace Waynelogic\Emporium\Filament\Resources\Units\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Waynelogic\Emporium\Filament\Resources\Units\UnitResource;

class ViewUnit extends ViewRecord
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
