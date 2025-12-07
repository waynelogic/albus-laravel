<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use XMLReader;
use SimpleXMLElement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Waynelogic\Emporium\Models\Category;

class Categories extends AbstractImport
{
    const string NODE_NAME = 'Группа';

    public function parse(): bool
    {
        $reader = new XMLReader();
        $reader->open(Storage::path('exchange' . DIRECTORY_SEPARATOR . $this->fileName));

        // URI основного пространства имен
        $namespaceUri = 'urn:1C.ru:commerceml_3';

        DB::beginTransaction();
        while ($reader->read()) {
            // Проверяем, что текущий элемент является началом тега
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->namespaceURI === $namespaceUri) {
                $localName = $reader->localName;

                switch ($localName) {
                    case 'Каталог':
                        $this->processCatalog($reader);
                        break;

                    case 'Группы':
                        $xItem = new SimpleXMLElement($reader->readOuterXML());
                        $this->processTree($xItem);
                        break;
                }
            }
        }
        DB::commit();

        $reader->close();

        $end_time = microtime(true);

        return true;
    }

    private function processTree(SimpleXMLElement $xItem)
    {
        $groupCount = count($xItem->children());
        if ($groupCount === 1) {
            $wrapper = $xItem->Группа;
            if (isset($wrapper->Группы)) {
                foreach ($wrapper->Группы->Группа as $subGroup) {
                    $this->importCategory($subGroup);
                }
            }
        } else {
            foreach ($xItem->Группа as $xGroup) {
                $this->importCategory($xGroup);
            }
        }
    }

    public function processItem(SimpleXMLElement $xItem): bool
    {
        return $this->importCategory($xItem);
    }

    private function importCategory(SimpleXMLElement $xItem, int $parent_id = null): bool
    {
        $guid = (string) $xItem->Ид;

        $obCategory = Category::query()->firstOrNew(['external_id' => $guid]);

        $data = [
            'external_id' => $guid,
            'name' => (string) $xItem->Наименование,
            'is_active' => true,
        ];

        if ($parent_id) {
            $data['parent_id'] = $parent_id;
        }

        $obCategory->fill($data)->save();

        if (isset($xItem->Группы)) {
            foreach ($xItem->Группы->Группа as $xSubItem) {
                $this->importCategory($xSubItem, $obCategory->id);
            }
        };

        return true;
    }
}
