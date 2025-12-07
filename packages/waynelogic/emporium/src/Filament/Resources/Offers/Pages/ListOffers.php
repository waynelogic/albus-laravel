<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Waynelogic\Emporium\Filament\Resources\Offers\OfferResource;

class ListOffers extends ListRecords
{
    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected Width | string | null $maxContentWidth = Width::Full;
}
