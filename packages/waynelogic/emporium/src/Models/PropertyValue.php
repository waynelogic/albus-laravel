<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class PropertyValue extends FileModel
{
    use HasExternalId, Sluggable, Sortable;

    protected string $sortableParentColumn = 'property_id';

    protected $fillable = [
        'property_id',
        'sort_order',
        'value',
    ];

    protected array $slugs = [
        'slug' => 'value'
    ];

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('property_value_covers');
    }
}
