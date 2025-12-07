<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\PropertyGroupResource;

class EditPropertyGroup extends EditRecord
{
    protected static string $resource = PropertyGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
