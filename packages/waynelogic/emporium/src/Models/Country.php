<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Country extends Model
{
    // TODO : Доделать страны
    use Sortable, Defaultable, HasExternalId;

    protected $fillable = [
        'currency_id',
        'name',
        'iso3',
        'iso2',
        'phone_code',
        'capital',
        'native',
    ];

    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'country_id');
    }
}
