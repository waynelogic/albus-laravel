<?php namespace Waynelogic\Emporium\Models;

use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Tax extends Model
{
    use Sortable, Defaultable;

    protected $fillable = [
        'name',
        'global',
        'percent',
        'description',
        'is_active',
    ];

    protected $casts = [
        'global' => 'boolean',
        'percent' => 'float',
    ];
}
