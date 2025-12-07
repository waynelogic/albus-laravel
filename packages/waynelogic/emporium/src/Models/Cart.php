<?php namespace Waynelogic\Emporium\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;

class Cart extends Model
{
    use HasExternalId;

    protected static function boot() : void
    {
        parent::boot();

        self::creating(function ($model) {
            if (! $model->currency_id) {
                // TODO: Get default currency from PRICE TYPE
                $model->currency_id = Currency::default()->first()?->id ?? null;
            }
        });
    }

    protected $fillable = [
        'currency_id',
        'customer_id',
        'price_type_id',
        'shipping_type_id',
        'payment_method_id',
        'coupon_code',
        'completed_at',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'completed_at' => 'datetime',
    ];

    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    public function price_type() : BelongsTo
    {
        return $this->belongsTo(PriceType::class);
    }
    public function shipping_type() : BelongsTo
    {
        return $this->belongsTo(ShippingType::class);
    }
    public function payment_method() : BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function cart_lines() : HasMany
    {
        return $this->hasMany(CartLine::class, 'cart_id');
    }
}
