<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Waynelogic\Emporium\Filament\Resources\ProductTypes\ProductTypeResource;

class EditProductType extends EditRecord
{
    protected static string $resource = ProductTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
