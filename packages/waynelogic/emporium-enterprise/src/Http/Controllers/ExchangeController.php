<?php

namespace Waynelogic\EmporiumEnterprise\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Waynelogic\EmporiumEnterprise\Resources\Catalog;

final class ExchangeController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(Request $request, Catalog $catalog)
    {
        $type = $_GET['type'] ?? 'catalog';
        $mode = $_GET['mode'] ?? 'checkauth';

        $object = match ($type) {
            'catalog' => $catalog,
            default => null,
        };

        if (!method_exists($object, $mode)) {
            throw new Exception('Метод "' . $mode . '" не найден!');
        }

        return $object->$mode();
    }
}
