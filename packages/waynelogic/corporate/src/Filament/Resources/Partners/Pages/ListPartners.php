<?php

namespace Waynelogic\Corporate\Filament\Resources\Partners\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Waynelogic\Corporate\Filament\Resources\Partners\PartnerResource;

class ListPartners extends ListRecords
{
    protected static string $resource = PartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
