<?php

namespace Waynelogic\Emporium\Filament\Resources\Properties\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Waynelogic\Emporium\Filament\Resources\Properties\PropertyResource;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\Product;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
