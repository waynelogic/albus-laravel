<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ValueLink extends Model
{
    protected $fillable = [
        'value_id',
        'attribute_id',
        'value_linkable_id',
        'value_linkable_type',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (ValueLink $valueLink) {
            if (! $valueLink->attribute_id) {
                $valueLink->attribute_id = $valueLink->value->attribute_id;
            }
        });
    }

    public function value() : BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function attribute() : BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
    public function value_linkable() : MorphMany
    {
        return $this->morphMany(ValueLink::class, 'value_linkable');
    }
}
