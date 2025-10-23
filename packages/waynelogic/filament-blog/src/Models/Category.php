<?php

namespace Waynelogic\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Waynelogic\Emporium\Models\Product;
use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia, HasExternalId, Activatable, Sluggable, Sortable;

    protected $table = 'blog_categories';

    protected array $slugs = [
        'slug' => 'name',
    ];

    protected $fillable = [
        'name',
        'slug',
        'preview_text',
        'description',
        'parent_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
