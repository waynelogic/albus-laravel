<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Waynelogic\Emporium\Filament\Resources\PropertyGroups\PropertyGroupResource;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\Product;

class ListPropertyGroups extends ListRecords
{
    protected static string $resource = PropertyGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
