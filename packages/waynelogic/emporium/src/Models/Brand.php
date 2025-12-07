<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Brand extends FileModel
{
    use HasExternalId, Sluggable, Sortable;

    protected array $slugs = [
        'slug' => 'name',
    ];

    protected $fillable = [
        'name',
        'slug',
        'preview_text',
        'description',
        'website',
        'attribute_data',
    ];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products', 'brand_id', 'category_id')->distinct();
    }
}
