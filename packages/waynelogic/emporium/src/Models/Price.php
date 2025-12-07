<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Waynelogic\Emporium\Services\CatalogService;

class Price extends Model
{
    protected $fillable = [
        'priceable_id',
        'priceable_type',
        'price_type_id',
        'price',
        'old_price',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Price $model) {
            if (!$model->price_type_id) {
                $model->price_type_id = CatalogService::getCurrentPriceTypeId();
            }
        });
    }

    protected $casts = [
        'price' => 'float',
        'old_price' => 'float',
    ];

    public function priceable() : MorphTo
    {
        return $this->morphTo();
    }

    public function price_type() : BelongsTo
    {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }
}
