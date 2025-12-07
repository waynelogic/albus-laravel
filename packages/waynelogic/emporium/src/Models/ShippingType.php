<?php namespace Waynelogic\Emporium\Models;

use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class ShippingType extends FileModel
{
    use Activatable, Sluggable, Sortable, Defaultable;

    protected $fillable = [
        'name',
        'code',
        'provider',
        'preview_text',
        'description',
        'svg-icon',
    ];

    protected array $slugs = [
        'code' => 'name',
    ];
}
