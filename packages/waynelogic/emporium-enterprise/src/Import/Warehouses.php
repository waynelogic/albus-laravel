<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Warehouse;

class Warehouses extends AbstractImport
{
    const string NODE_NAME = 'Склад';

    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;

        $obStorage = Warehouse::query()->firstOrNew(['external_id' => $guid]);

        $obStorage->fill([
            'name' => (string) $xItem->Наименование,
        ])->save();

        return true;
    }
}
