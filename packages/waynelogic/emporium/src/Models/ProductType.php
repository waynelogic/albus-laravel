<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;

class ProductType extends Model
{
    use Sluggable, HasExternalId;

    protected $fillable = [
        'name',
        'slug',
    ];
    protected array $slugs = [
        'slug' => 'name',
    ];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'product_type_id');
    }

    public function default_brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class, 'default_brand_id');
    }

    public function default_category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'default_category_id');
    }

    public function default_country() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'default_country_id');
    }

    public function default_unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'default_unit_id');
    }


    public function properties() : BelongsToMany
    {
        return $this->belongsToMany(Property::class, $this->tablePrefix . 'product_types_properties', 'product_type_id', 'property_id')
            ->withPivot('label', 'sort_order', 'is_required', 'show_in_filter', 'filter_type');
    }

    public function options() : BelongsToMany
    {
        return $this->belongsToMany(Property::class, $this->tablePrefix . 'product_types_options', 'product_type_id', 'option_id')
            ->withPivot('sort_order', 'is_required', 'show_in_filter', 'filter_type');
    }
}
