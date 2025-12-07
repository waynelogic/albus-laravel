<?php

namespace Waynelogic\EmporiumEnterprise\Import;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Log;
use SimpleXMLElement;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Waynelogic\Emporium\Enums\ProductKind;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\Emporium\Models\Category;
use Waynelogic\Emporium\Models\Product;
use Waynelogic\Emporium\Models\ProductType;
use Waynelogic\Emporium\Models\Property;
use Waynelogic\Emporium\Models\PropertyAssignment;
use Waynelogic\Emporium\Models\Unit;

class Products extends AbstractImport
{
    const string NODE_NAME = 'Товар';

    public array $arUnits;
    public array $arCategories;
    public Collection $arProductTypes;
    private Collection $arProperties;
    const string NULL_VALUE = '00000000-0000-0000-0000-000000000000';

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function processItem(SimpleXMLElement $xItem): bool
    {
        $guid = (string) $xItem->Ид;

        $group_guid = (string) $xItem->Группы->Ид ?? null;

        if (empty($group_guid)) {
            Log::info('Product without group: ' . $guid);
            return false;
        }

        $obProduct = Product::query()->firstOrNew(['external_id' => $guid]);

        $requisites = $this->processRequisites($xItem->ЗначенияРеквизитов);

        $obProductType = $this->getProductType($requisites['ВидНоменклатуры']);

        $description = (string) $xItem->Описание;

        $data = [
            'name' => (string) $xItem->Наименование,
            'kind' => ProductKind::Variable,
            'description' => $description,
            'preview_text' => $this->getPreviewText($description),
            'sku' => (string) $xItem->Артикул,
            'is_published' => true,
            'unit_id' => $this->arUnits[(int)$xItem->БазоваяЕдиница] ?? null,
            'product_type_id' => $obProductType->id,
            'category_id' => $this->arCategories[$group_guid] ?? null,
            'code' => $requisites['Код'],
        ];

        $obProduct->fill($data)->save();

        $incomingPropertyIds = [];

        if (!empty($xItem->ЗначенияСвойств)) {
            foreach ($xItem->ЗначенияСвойств->ЗначенияСвойства as $xProperty) {
                $sPropertyGuid = (string) $xProperty->Ид;
                $mValue = (string) $xProperty->Значение;
                $obProperty = $this->arProperties[$sPropertyGuid] ?? null;
                if (empty($mValue) || !$obProperty) {
                    continue;
                }

                // Для списков (DROPDOWN/LIST) находим ID из PropertyValue по external_id
                if (in_array($obType = $obProperty->type, [PropertyType::DROPDOWN, PropertyType::LIST])) {
                    $valueRecord = $obProperty->values()->where('external_id', $mValue)->first();
                    if (!$valueRecord) {
                        // Например, логируем или пропускаем
                        continue;
                    }
                    $mValue = $valueRecord->id;
                }

                // Создаём или обновляем привязку
                PropertyAssignment::updateOrCreate(
                    [
                        'assignable_id'   => $obProduct->id,
                        'assignable_type' => Product::class,
                        'property_id'     => $obProperty->id,
                    ],
                    [
                        'value_text'     => $obType === PropertyType::TEXT ? $mValue : null,
                        'value_number'   => $obType === PropertyType::NUMBER ? (float) $mValue : null,
                        'value_boolean'  => $obType === PropertyType::BOOLEAN ? filter_var($mValue, FILTER_VALIDATE_BOOLEAN) : null,
                        'value_id'       => in_array($obType, [PropertyType::DROPDOWN, PropertyType::LIST]) ? $mValue : null,
                        // value_json не используем — можно добавить позже
                    ]
                );

                // Запоминаем, что это свойство "актуально"
                $incomingPropertyIds[] = $obProperty->id;
            }
        }

        PropertyAssignment::where('assignable_id', $obProduct->id)
            ->where('assignable_type', Product::class)
            ->whereNotIn('property_id', $incomingPropertyIds)
            ->delete();

        if (!empty($xItem->Картинка)) {
            $imagesDeleted = false;
            foreach ($xItem->Картинка as $xImage) {
                $imagePath = 'exchange' . DIRECTORY_SEPARATOR . $xImage;
                if (!Storage::exists($imagePath)) break;

                if (!$imagesDeleted) {
                    $obProduct->clearMediaCollection('product_gallery');
                    $obProduct->clearMediaCollection('product-gallery');
                    $imagesDeleted = true;
                }

                $obProduct->addMediaFromDisk($imagePath)->toMediaCollection('product-gallery');
            }
        }

        unset($obProduct);

        return true;
    }

    public function prepareVars(): void
    {
        $this->arUnits = Unit::query()->pluck('id', 'code')->toArray();
        $this->arCategories = Category::query()->pluck('id', 'external_id')->toArray();
        $this->arProductTypes = ProductType::all()->keyBy('name');
        $this->arProperties = Property::select(['external_id', 'name', 'type', 'id'])->get()->keyBy('external_id');
    }

    private function processRequisites(SimpleXMLElement $xData): array
    {
        $result = [];

        foreach ($xData->ЗначениеРеквизита as $requisite) {
            $result[(string)$requisite->Наименование] = (string)$requisite->Значение;
        }

        return $result;
    }


    private function getProductType(string $sType): ProductType
    {
        $obType = $this->arProductTypes[$sType] ?? null;
        if (!$obType) {
            $obType = ProductType::firstOrCreate(['name' => $sType]);
            $this->arProductTypes[$sType] = $obType;
        }
        return $obType;
    }

    private function getPreviewText(string $description): string
    {
        if (empty($description)) return '';
        $match = preg_split('/[.!?]+/', $description, 2, PREG_SPLIT_NO_EMPTY);
        return $match ? trim($match[0]) . '.' : $description;
    }
}
