<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class PriceType extends Model
{
    use HasExternalId, Sortable, Defaultable, SoftDeletes, Activatable;

    protected $fillable = [
        'currency_id',
        'is_active',
        'name',
        'code',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
