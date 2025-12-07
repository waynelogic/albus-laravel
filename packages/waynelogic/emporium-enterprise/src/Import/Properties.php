<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use SimpleXMLElement;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\Emporium\Models\Property;
use Waynelogic\Emporium\Models\PropertyGroup;
use Waynelogic\Emporium\Models\PropertyValue;

class Properties extends AbstractImport
{
    const string NODE_NAME = 'Свойство';

    public $propertyGroup;

    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;
        $obProperty = Property::query()->firstOrNew([
            'external_id' => $guid
        ]);
        $obProperty->name = (string) $xItem->Наименование;

        $obProperty->type = match ((string) $xItem->ТипЗначений) {
            'Справочник' => PropertyType::DROPDOWN,
            'Число' => PropertyType::NUMBER,
            'Строка' => PropertyType::TEXT,
            'Булево' => PropertyType::BOOLEAN,
            default => PropertyType::TEXT,
        };
        if (!$obProperty->exists) {
            $obProperty->property_group_id = $this->propertyGroup->id;
        }

        $obProperty->save();

        if ($obProperty->type === PropertyType::DROPDOWN && !empty($xItem->ВариантыЗначений->Справочник)) {
            $valuesToUpsert = [];
            foreach ($xItem->ВариантыЗначений->Справочник as $xValue) {
                $valuesToUpsert[] = [
                    'external_id' => (string) $xValue->ИдЗначения,
                    'value' => (string) $xValue->Значение,
                    'property_id' => $obProperty->id,
                ];
            }

            if (!empty($valuesToUpsert)) {
                PropertyValue::upsert(
                    $valuesToUpsert,
                    ['external_id'], // уникальный ключ для поиска
                    ['value', 'property_id'] // поля, которые обновлять
                );
            }
        }

        unset($obProperty);

        return true;
    }

    public function prepareVars(): void
    {
        [$type] = explode('_', $this->fileName, 2) + [''];
        $name = $type === 'propertiesGoods' ? 'Свойства' : 'Опции';

        $obPropertyGroup = PropertyGroup::query()->firstOrNew([
            'name' => $name
        ]);
        if (!$obPropertyGroup->exists) {
            $obPropertyGroup->save();
        }
        $this->propertyGroup = $obPropertyGroup;
    }
}
