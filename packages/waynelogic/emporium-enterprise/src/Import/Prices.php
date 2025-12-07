<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\PriceType;

class Prices extends AbstractImport
{
    const string NODE_NAME = 'Предложение';

    public array $arPriceTypes;

    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;

        $obOffer = Offer::query()->where('external_id', $guid)->first();
        if (!$obOffer) return false;

        foreach ($xItem->Цены->Цена as $xPrice) {
            $priceTypeId = $this->arPriceTypes[(string) $xPrice->ИдТипаЦены] ?? null;

            if (!$priceTypeId) return false;

            $obPrice = $obOffer->prices()->firstOrNew([
                'price_type_id' => $priceTypeId,
            ]);

            $obPrice->price = (float) $xPrice->ЦенаЗаЕдиницу;
            $obPrice->save();
        }
        return true;
    }

    public function prepareVars(): void
    {
        $this->arPriceTypes = PriceType::all()->pluck('id','external_id')->toArray();
    }
}
