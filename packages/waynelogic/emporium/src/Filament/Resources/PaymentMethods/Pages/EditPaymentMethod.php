<?php

namespace Waynelogic\Emporium\Filament\Resources\PaymentMethods\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\PaymentMethodResource;

class EditPaymentMethod extends EditRecord
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
