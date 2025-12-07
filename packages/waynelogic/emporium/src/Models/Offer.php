<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Waynelogic\Emporium\Services\CatalogService;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;

class Offer extends FileModel
{
    use HasExternalId, Sluggable;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'code',
        'sku',
        'barcode',
        'attribute_data',
        'dimension_unit_id',
        'weight_unit_id',
        'weight',
        'length',
        'width',
        'height',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'attribute_data' => 'array',
    ];

    protected array $slugs = [
        'slug' => 'name'
    ];

    public function dimension_unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'dimension_unit_id');
    }
    public function weight_unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'weight_unit_id');
    }
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Stocks
    public function stocks() : MorphMany
    {
        return $this->morphMany(Stock::class, 'stockable');
    }
    public function main_stock() : MorphOne
    {
        return $this->morphOne(Stock::class, 'stockable')
            ->where('warehouse_id', CatalogService::getCurrentWarehouseId())
            ->whereNotNull('warehouse_id');
    }

    // Prices
    public function prices() : MorphMany
    {
        return $this->morphMany(Price::class, 'priceable');
    }
    public function main_price() : MorphOne
    {
        return $this->morphOne(Price::class, 'priceable')
            ->where('price_type_id', CatalogService::getCurrentPriceTypeId())
            ->whereNotNull('price_type_id');
    }

    public function quantity() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->stocks()->sum('quantity'),
        );
    }

    public function cart_lines() : MorphMany
    {
        return $this->morphMany(CartLine::class, 'purchasable');
    }
}
