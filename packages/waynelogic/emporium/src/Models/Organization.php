<?php namespace Waynelogic\Emporium\Models;

use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Organization extends Model
{
    use HasExternalId, Sortable, Defaultable, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'full_name',
        'prefix',
        'legal_state',
        'identifiers',
    ];

    protected $casts = [
        'identifiers' => 'array',
    ];

    protected array $slugs = [
        'slug' => 'name',
    ];
}
