<?php

namespace Waynelogic\Emporium\Filament\Resources\ShippingTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\ShippingTypeResource;

class ListShippingTypes extends ListRecords
{
    protected static string $resource = ShippingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
