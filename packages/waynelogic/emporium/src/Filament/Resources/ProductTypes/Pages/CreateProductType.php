<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\ProductTypeResource;

class CreateProductType extends CreateRecord
{
    protected static string $resource = ProductTypeResource::class;
}
