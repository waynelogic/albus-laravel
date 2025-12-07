<?php

namespace Waynelogic\Emporium\Services;

use Waynelogic\Emporium\Models\PriceType;
use Waynelogic\Emporium\Models\Warehouse;
use Waynelogic\FilamentCms\Database\Traits\Singleton;

class CatalogService
{
    use Singleton;

    public int | null $currentPriceTypeId = null;
    public int | null $currentWarehouseId = null;

    protected function init(): void
    {
        $arPriceTypes = PriceType::query()->get(['id', 'is_default']);
        if ($arPriceTypes->count() === 0) {
            $this->currentPriceTypeId = null;
        } elseif ($arPriceTypes->count() === 1) {
            $this->currentPriceTypeId = $arPriceTypes->first()->id;
        } else {
            $this->currentPriceTypeId = $arPriceTypes->where('is_default', true)->first()->id;
        }
    }

    public static function setCurrentPriceTypeId(int $priceTypeId): void
    {
        self::instance()->currentPriceTypeId = $priceTypeId;
    }

    public static function getCurrentPriceTypeId(): int | null
    {
        return self::instance()->currentPriceTypeId;
    }

    public static function getCurrentWarehouseId()
    {
        $current = self::instance()->currentWarehouseId;
        if ($current) return $current;

        $arWarehouses = Warehouse::query()->get(['id', 'is_default']);

        if ($arWarehouses->count() === 0) {
            return null;
        } elseif ($arWarehouses->count() === 1) {
            return $arWarehouses->first()->id;
        } else {
            return $arWarehouses->where('is_default', true)->first()->id;
        }
    }
}
