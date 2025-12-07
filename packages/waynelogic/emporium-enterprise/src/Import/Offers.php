<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\Product;

class Offers extends AbstractImport
{
    const string NODE_NAME = 'Предложение';
    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;
        $obOffer = Offer::query()->firstOrNew(['external_id' => $guid]);

        $data = [
            'name' => (string) $xItem->Наименование,
            'sku' => (string) $xItem->Артикул ?? null,
        ];
        if (!$obOffer->exists) {
            $product_guid = explode('#', $guid)[0];
            $obProduct = Product::query()->where('external_id', $product_guid)->first();

            if (!$obProduct) return false;

            $data['product_id'] = $obProduct->id;
        }
        $obOffer->fill($data)->save();

        return true;
    }
}
