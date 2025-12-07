<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;

class Address extends Model
{
    use HasExternalId;

    protected $fillable = [
        'name',
        'country',
        'street',
        'city',
        'state',
        'zip',
        'full_address',
        'addressable_id',
        'addressable_type',
    ];
    protected $casts = [
        'zip' => 'integer',
    ];
    public function addressable() : MorphTo
    {
        return $this->morphTo();
    }
}
