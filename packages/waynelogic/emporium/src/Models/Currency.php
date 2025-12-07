<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sortable;


class Currency extends Model
{
    use Activatable, Sortable, Defaultable, HasExternalId;

    protected $fillable = [
        'is_active',
        'is_default',
        'name',
        'code',
        'number',
        'symbol',
        'rate',
    ];

    protected $casts = [
        'rate' => 'float',
    ];

    public function countries() : HasMany
    {
        return $this->hasMany(Country::class, 'currency_id');
    }

    public function price_types() : HasMany
    {
        return $this->hasMany(PriceType::class, 'currency_id');
    }
}
