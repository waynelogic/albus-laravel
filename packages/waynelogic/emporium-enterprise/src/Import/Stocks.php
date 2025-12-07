<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\Stock;
use Waynelogic\Emporium\Models\Warehouse;

class Stocks extends AbstractImport
{
    const string NODE_NAME = 'Предложение';

    public array $arWarehouses = [];

    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;

        $obOffer = Offer::where('external_id', $guid)->first(['id']);
        if (!$obOffer) return false;

        $values = [];
        foreach ($xItem->Остатки->Остаток->Склад as $xStock) {
            $warehouse_id = $this->arWarehouses[(string) $xStock->Ид] ?? null;
            if (!$warehouse_id) return false;

            $values[] = [
                'stockable_type' => Offer::class,
                'stockable_id'   => $obOffer->id,
                'warehouse_id'   => $warehouse_id,
                'quantity'       => (int) $xStock->Количество,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        // Уникальность по: (stockable_type, stockable_id, warehouse_id)
        Stock::upsert(
            $values,
            ['stockable_type', 'stockable_id', 'warehouse_id'],
            ['quantity', 'updated_at']
        );

        return true;
    }

    public function prepareVars(): void
    {
        $this->arWarehouses = Warehouse::query()->pluck('id', 'external_id')->toArray();
    }
}
