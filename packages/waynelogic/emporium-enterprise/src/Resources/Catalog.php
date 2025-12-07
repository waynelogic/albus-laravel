<?php namespace Waynelogic\EmporiumEnterprise\Resources;

use Illuminate\Support\Facades\Storage;
use Waynelogic\EmporiumEnterprise\Import;
class Catalog extends AbstractResource
{
    public function parse($fileName): string
    {
        set_time_limit(900);

        $parsers = [
            'propertiesGoods' => Import\Properties::class,
            'propertiesOffers' => Import\Properties::class,
            'units' => Import\Units::class,
            'storages' => Import\Warehouses::class,
            'groups' => Import\Categories::class,
            'goods' => Import\Products::class,
            'offers' => Import\Offers::class,
            'rests' => Import\Stocks::class,
            'priceLists' => Import\PriceLists::class,
            'prices' => Import\Prices::class
        ];

        $customImports = config('emporium-enterprise.custom-imports');

        if (!empty($customImports)) {
            $parsers = array_merge($parsers, $customImports);
        }

        [$type] = explode('_', $fileName, 2) + [''];

        if (!isset($parsers[$type])) {
            return false;
        }

        (new $parsers[$type]($fileName))->parse();

        return $this->success();
    }

    public function deactivate() : string
    {
        return $this->success();
    }

    public function complete() : string
    {
//        $result = Storage::delete(self::EXCHANGE_FOLDER);
//        if (!$result) {
//            return $this->failure('Не удалось удалить файлы');
//        }
        return $this->success();
    }
}
