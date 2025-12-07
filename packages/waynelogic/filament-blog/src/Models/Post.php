<?php

namespace Waynelogic\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Models\BackendUser;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia, Activatable, Sluggable;
    const ACTIVE_FIELD = 'is_published';

    protected $table = 'blog_posts';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'metadata',
        'published_at',
        'preview_text',
        'content',
        'has_cover',
        'has_gallery',
    ];

    protected $casts = [
        'metadata' => 'array',
        'published_at' => 'datetime',
        'has_cover' => 'boolean',
        'has_gallery' => 'boolean',
    ];

    protected array $slugs = [
        'slug' => 'title',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Post $post) {
            $post->has_cover = $post->getFirstMediaUrl('blog_post_covers') ? true : false;
            $post->has_gallery = $post->getMedia('blog_post_gallery')->isNotEmpty();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(BackendUser::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag', 'post_id', 'tag_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('published_at', '<=', now());
    }

    public function scopeHasCover($query)
    {
        return $query->where('has_cover', true);
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('blog_post_covers');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->nonQueued();
    }

    public function getGalleryAttribute(): array
    {
        return $this->getMedia('blog_post_gallery')->map(function (Media $media) {
            return [
                'preview' => $media->getUrl('thumb'),
                'url' => $media->getUrl(),
            ];
        })->toArray();
    }
}
