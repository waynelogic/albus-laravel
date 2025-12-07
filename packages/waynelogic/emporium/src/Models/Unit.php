<?php namespace Waynelogic\Emporium\Models;

use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Unit extends Model
{
    use Sortable, Defaultable;

    protected $fillable = [
        'name',
        'short_name',
        'international_name',
        'code',
        'sort_order',
        'is_default',
    ];

    protected $casts = [
        'code' => 'integer',
    ];

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
