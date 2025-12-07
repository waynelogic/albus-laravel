<?php

namespace Waynelogic\Emporium\Filament\Resources\OrderStatuses\Pages;

use Filament\Resources\Pages\CreateRecord;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\OrderStatusResource;

class CreateOrderStatus extends CreateRecord
{
    protected static string $resource = OrderStatusResource::class;
}
