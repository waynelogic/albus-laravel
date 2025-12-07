<?php

namespace Waynelogic\Emporium\Filament\Resources\PaymentMethods\Pages;

use Filament\Resources\Pages\CreateRecord;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\PaymentMethodResource;

class CreatePaymentMethod extends CreateRecord
{
    protected static string $resource = PaymentMethodResource::class;
}
