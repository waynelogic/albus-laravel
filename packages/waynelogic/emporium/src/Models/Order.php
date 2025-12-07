<?php namespace Waynelogic\Emporium\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;

class Order extends FileModel
{
    use HasExternalId, SoftDeletes;

    protected $fillable = [
        'number',
        'user_id',
        'order_status_id',
        'organization_id',
        'currency_id',
        'price_type_id',
        'shipping_type_id',
        'payment_method_id',
        'secret_key',
        'total_price',
        'shipping_price',
        'notes',
        'user_data',
        'attribute_data',
        'deleted_at',
    ];

    const string EXTERNAL_ID_FIELD = 'number';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function price_type(): BelongsTo
    {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }

    public function shipping_type(): BelongsTo
    {
        return $this->belongsTo(ShippingType::class, 'shipping_type_id');
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
