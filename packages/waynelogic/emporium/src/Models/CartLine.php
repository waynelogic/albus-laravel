<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CartLine extends Model
{
    protected $fillable = [
        'cart_id',
        'purchasable_id',
        'purchasable_type',
        'quantity',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function cart() : BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function purchasable() : MorphTo
    {
        return $this->morphTo();
    }
}
