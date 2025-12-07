<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Waynelogic\Emporium\Services\CatalogService;

class Stock extends Model
{
    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Stock $model) {
            if (!$model->warehouse_id) {
                $model->warehouse_id = CatalogService::getCurrentWarehouseId();
            }
        });
    }

    protected $casts = [
        'quantity' => 'integer',
    ];

    protected $fillable = [
        'warehouse_id',
        'stockable_id',
        'stockable_type',
        'quantity',
    ];

    public function warehouse() : BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function stockable() : MorphTo
    {
        return $this->morphTo();
    }
}
