<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;
use Waynelogic\Emporium\Filament\Resources\Offers\OfferResource;

class EditOffer extends EditRecord
{
    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected Width | string | null $maxContentWidth = Width::Full;
}
