<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Waynelogic\Emporium\Filament\Resources\Offers\OfferResource;

class PriceList extends ListRecords
{
    protected static string $resource = OfferResource::class;

    protected static ?string $title = 'Прайс-лист';
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
