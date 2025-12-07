<?php

namespace Waynelogic\Emporium\Filament\Resources\ShippingTypes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\ShippingTypeResource;

class EditShippingType extends EditRecord
{
    protected static string $resource = ShippingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
