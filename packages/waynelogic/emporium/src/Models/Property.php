<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\Emporium\Enums\PropertyType;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Property extends Model
{
    use HasExternalId, Sortable, Sluggable;

    protected $fillable = [
        'property_group_id',
        'unit_id',
        'name',
        'handle',
        'section',
        'type',
        'is_required',
        'default_value_id',
        'configuration',
    ];

    protected array $slugs = [
        'handle' => 'name',
    ];

    protected $casts = [
        'type' => PropertyType::class,
        'is_required' => 'boolean',
        'configuration' => 'array',
    ];

    public function unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function property_group() : BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class, 'property_group_id');
    }

    public function values() : HasMany
    {
        return $this->hasMany(PropertyValue::class, 'property_id');
    }

    public function product_type_properties(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class, $this->tablePrefix . 'product_types_properties', 'property_id', 'product_type_id')
            ->withPivot('label', 'filter_type', 'show_in_filter', 'is_required', 'sort_order');
    }
    public function product_types_options(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class,$this->tablePrefix . 'product_types_options','option_id','product_type_id')
            ->withPivot('label', 'filter_type', 'show_in_filter', 'is_required', 'sort_order');
    }

    public function isSelectType(): bool
    {
        return in_array($this->type, [PropertyType::DROPDOWN, PropertyType::LIST]);
    }
}
