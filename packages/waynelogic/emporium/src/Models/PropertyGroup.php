<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class PropertyGroup extends Model
{
    use Sortable, Sluggable;

    protected $fillable = [
        'name',
        'handle',
    ];

    protected array $slugs = [
        'handle' => 'name',
    ];

    public function properties() : HasMany
    {
        return $this->hasMany(Property::class, 'property_group_id');
    }
}
