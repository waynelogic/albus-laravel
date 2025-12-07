<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;
use Waynelogic\Emporium\Database\Traits\HasReviews;
use Waynelogic\Emporium\Services\CatalogService;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;

class Product extends FileModel
{
    use HasExternalId, Sluggable, Searchable;
    use HasReviews;

    protected $fillable = [
        'product_type_id',
        'brand_id',
        'category_id',
        'country_id',
        'unit_id',
        'name',
        'slug',
        'preview_text',
        'description',
        'is_published',
        'published_at',
        'code',
        'sku',
        'barcode',
        'backorder',
        'is_virtual',
    ];

    protected array $slugs = [
        'slug' => 'name',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'backorder' => 'boolean',
        'is_virtual' => 'boolean',
        'is_bundle' => 'boolean',
    ];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'preview_text' => $this->preview_text,
            'sku' => $this->sku,
        ];
    }

    public static function getSortingOptions(): array
    {
        return [
            'price | asc' => 'Цена по возрастанию',
            'price | desc' => 'Цена по убыванию',
            'quantity | asc' => 'Количество по возрастанию',
            'quantity | desc' => 'Количество по убыванию',
        ];
    }

    public function product_type() : BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function associations(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, $this->tablePrefix . 'product_associations', 'product_parent_id', 'product_target_id')
            ->withPivot('type');
    }
    public function associated(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, $this->tablePrefix . 'product_associations', 'product_target_id', 'product_parent_id')
            ->withPivot('type');
    }

    public function offer() : HasOne
    {
        return $this->hasOne(Offer::class, 'product_id');
    }

    public function offers() : HasMany
    {
        return $this->hasMany(Offer::class, 'product_id');
    }

    public function stocks() : HasManyThrough
    {
        return $this->hasManyThrough(
            Price::class,
            Offer::class,
            'product_id',     // Foreign key в offers
            'stockable_id'    // Foreign key в prices
        )->where('stockable_type', Offer::class);
    }

    public function main_stock() : HasOneThrough
    {
        return $this->hasOneThrough(
            Stock::class,
            Offer::class,
            'product_id',     // Foreign key в offers
            'stockable_id'    // Foreign key в stocks
        )->where('stockable_type', Offer::class);
    }

    public function prices() : HasManyThrough
    {
        return $this->hasManyThrough(
            Price::class,
            Offer::class,
            'product_id',     // Foreign key в offers
            'priceable_id'    // Foreign key в prices
        )->where('priceable_type', Offer::class);
    }

    public function main_price() : HasOneThrough
    {
        return $this->hasOneThrough(
            Price::class,
            Offer::class,
            'product_id',     // Foreign key в offers
            'priceable_id'    // Foreign key в prices
        )->where('priceable_type', Offer::class)
            ->where('price_type_id', CatalogService::getCurrentPriceTypeId());
    }

    public function property_values(): MorphMany
    {
        return $this->morphMany(PropertyAssignment::class, 'assignable');
    }

    public function getPropertyArrayAttribute(): array
    {
        return $this->property_values->mapWithKeys(function ($property_value) {
            return [$property_value->property->slug => $property_value->value];
        })->toArray();
    }

    public function quantity() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->stocks()->sum('quantity'),
        );
    }

    public function coverUrl() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('product-gallery')
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-gallery');
    }

    public function gallery() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('product-gallery')->map(fn ($media) => $media->getUrl())->toArray()
        );
    }

    public function url() : Attribute
    {
        return Attribute::make(
            get: fn () => route('catalog.product',
                ['category' => $this->category->slug, 'product' => $this->slug],
                absolute: true,
            ),
        );
    }

    // Category Scope
    public function scopeCategory($query, int | Category $category, bool $withSubCategories = false)
    {
        // Получаем ID категории (поддержка передачи как ID, так и модели)
        $categoryId = $category instanceof Category ? $category->id : $category;

        if (!$withSubCategories) {
            return $query->where('category_id', $categoryId);
        }

        // Используем SimpleTree: получаем все descendant IDs + саму категорию
        $categoryModel = $category instanceof Category ? $category : Category::find($categoryId);
        $descendantIds = $categoryModel->descendantIds(); // ← Это BFS, 1–N запросов, но эффективно

        $allCategoryIds = array_merge([$categoryId], $descendantIds);

        return $query->whereIn('category_id', $allCategoryIds);
    }
}
