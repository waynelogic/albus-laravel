<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\SimpleTree;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\SluggableTree;
use Waynelogic\FilamentCms\Database\Traits\Sortable;


class Category extends FileModel
{
    use HasExternalId, Sluggable, Sortable, SimpleTree, SluggableTree;

    protected $fillable = [
        'name',
        'slug',
        'preview_text',
        'description',
        'attribute_data',
        'parent_id',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected array $slugs = [
        'slug' => 'name',
    ];

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }


    public function getProductCountAttribute() : int
    {
        return $this->products()->count();
    }
    public function getIconUrlAttribute() : string
    {
        return $this->getFirstMediaUrl('category_icons');
    }

//    public function iconUrl() : Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->getFirstMediaUrl('category_icons'),
//        );
//    }
//    public function iconUrl() : Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->getFirstMediaUrl('category_icons'),
//        );
//    }

    public function coverUrl() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('category_covers'),
        );
    }

//    public function productCount() : Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->products()->count(),
//        );
//    }

    public function url() : Attribute
    {
        return Attribute::make(
            get: fn () => route('catalog.category', ['category' => $this->slug]),
        );
    }
//    public function product_types() : HasManyThrough
//    {
//        return $this->hasManyThrough(ProductType::class, Product::class, 'category_id', 'product_id');
//    }
}
