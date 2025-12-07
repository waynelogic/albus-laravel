<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Waynelogic\Emporium\Enums\PropertyType;

class PropertyAssignment extends Model
{
    protected $appends = ['value'];

    protected $fillable = [
        'property_id',
        'value_text',
        'value_number',
        'value_boolean',
        'value_json',
        'value_id',
        'assignable_id',
        'assignable_type',
    ];

    protected $casts = [
        'value_json' => 'array',
        'value_boolean' => 'boolean',
        'value_number' => 'float',
    ];

    public function assignable(): MorphTo
    {
        return $this->morphTo();
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // Только для списков с картинками
    public function valueItem(): BelongsTo
    {
        return $this->belongsTo(PropertyValue::class, 'value_id');
    }

    public function getTypeAttribute()
    {
        return $this->property?->type;
    }

    // Магия: всегда правильное значение
    public function getValueAttribute() : mixed
    {
        return match ($this->property?->type) {
            PropertyType::TEXT     => $this->value_text,
            PropertyType::NUMBER   => $this->value_number,
            PropertyType::BOOLEAN  => $this->value_boolean,
//            PropertyType::JSON     => $this->value_json,
            PropertyType::DROPDOWN,
            PropertyType::LIST     => $this->valueItem?->value,
            default                => $this->value_text,
        };
    }

    public function setValueAttribute($value)
    {
        match ($this->property?->type) {
            PropertyType::TEXT     => $this->value_text = $value,
            PropertyType::NUMBER   => $this->value_number = $value,
            PropertyType::BOOLEAN  => $this->value_boolean = $value,
//            PropertyType::JSON     => $this->value_json = $value,
            PropertyType::DROPDOWN,
            PropertyType::LIST     => $this->value_id = $value,
            default                => $this->value_text = $value,
        };
    }
}
