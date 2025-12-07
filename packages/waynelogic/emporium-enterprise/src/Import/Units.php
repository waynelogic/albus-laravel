<?php namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Models\Unit;

class Units extends AbstractImport
{

    const string NODE_NAME = 'ЕдиницаИзмерения';
    public function processItem(SimpleXMLElement $xItem): bool
    {
        $code = (int) $xItem->Код;

        if (empty($code)) return false;

        $obUnit = Unit::query()->firstOrNew(['code' => $code]);

        $obUnit->fill([
            'name' => (string) $xItem->НаименованиеПолное,
            'short_name' => (string) $xItem->НаименованиеКраткое,
            'international_name' => $xItem->МеждународноеСокращение,
        ]);

        $obUnit->save();

        return true;
    }
}
