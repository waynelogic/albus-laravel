<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Currency;
use Waynelogic\Emporium\Models\PriceType;

class PriceLists extends AbstractImport
{
    const string NODE_NAME = 'ТипЦены';

    public array $arCurrencies;

    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;

        $obPriceType = PriceType::query()->firstOrNew(['external_id' => $guid]);

        $obPriceType->fill([
            'name' => (string) $xItem->Наименование,
            'external_id' => $guid,
            'currency_id' => $this->arCurrencies[(string) $xItem->Валюта],
        ]);

        $obPriceType->save();

        return true;
    }

    public function prepareVars(): void
    {
        $this->arCurrencies = Currency::query()->pluck('id', 'code')->toArray();
        if (empty($this->arCurrencies)) {
            Currency::query()->updateOrCreate([
                'number' => 643,
            ],[
                'name' => 'Российский рубль',
                'code' => 'RUB',
                'number' => 643,
                'symbol' => '₽',
                'is_active' => true,
                'is_default' => true,
            ]);
            $this->arCurrencies = Currency::query()->pluck('id', 'code')->toArray();
        }
    }
}
