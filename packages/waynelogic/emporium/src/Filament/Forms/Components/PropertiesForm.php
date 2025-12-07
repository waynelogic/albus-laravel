<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\Emporium\Models\Property;

class PropertiesForm extends Group
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->statePath('property_values');

        $this->dehydrated(false);

        // Теперь можно безопасно использовать $this->getContainer()
        $this->afterStateHydrated(function (PropertiesForm $component, $record) {
            if (!$record || !$record->relationLoaded('property_values')) {
                $record?->loadMissing('property_values.property', 'property_values.valueItem');
            }

            $state = [];

            foreach ($record?->property_values ?? [] as $assignment) {
                $propertyId = $assignment->property_id;

                if ($assignment->property?->isSelectType()) {
                    $state[$propertyId] = $assignment->value_id;
                } else {
                    $state[$propertyId] = $assignment->value;
                }
            }

            $component->state($state);
        });

        $this->saveRelationshipsUsing(function (PropertiesForm $component, $record, array $state) {
            $record->property_values()->delete();

            foreach ($state as $propertyId => $value) {
                if ($value === null || $value === '') {
                    continue;
                }

                $property = Property::find($propertyId);
                if (!$property) continue;

                $data = ['property_id' => $propertyId];

                if ($property->isSelectType()) {
                    $data['value_id'] = $value;
                } else {
                    match ($property->type) {
                        PropertyType::NUMBER   => $data['value_number'] = (float) $value,
                        PropertyType::BOOLEAN  => $data['value_boolean'] = (bool) $value,
                        default                => $data['value_text'] = (string) $value,
                    };
                }

                $record->properties()->create($data);
            }
        });
    }

    public function properties($arProperties): static
    {
        $this->childComponents(fn () => $this->generateProperties($arProperties));
        return $this;
    }

    // TODO Property Unit
    private function generateProperties($arProperties)
    {
        return $arProperties->map(function (Property $property) {
            $fieldName = (string) $property->id;

            /*
            if ($property->isSelectType()) {
                return Select::make($fieldName)
                    ->label($property->name)
                    ->options($property->values->pluck('value', 'id'))
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->value);
//                        ->hintIcon('heroicon-o-photo', fn () => $this->getState() ?
//                            optional(PropertyValue::find($this->getState()))->getFirstMediaUrl('covers') : false);
            }
            */

            return match ($property->type) {
                PropertyType::DROPDOWN, PropertyType::LIST => Select::make($fieldName)
                    ->label($property->name)
                    ->options($property->values->pluck('value', 'id'))
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->value),
                PropertyType::TEXT     => TextInput::make($fieldName)
                    ->label($property->name),
                PropertyType::NUMBER   => TextInput::make($fieldName)
                    ->label($property->name)
                    ->numeric(),
                PropertyType::BOOLEAN  => Toggle::make($fieldName)
                    ->label($property->name),
                default                => null,
            };
        })
            ->filter()
            ->values()
            ->toArray();
    }
}
