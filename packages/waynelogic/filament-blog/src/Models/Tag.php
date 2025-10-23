<?php

namespace Waynelogic\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Tag extends Model
{
    use Sluggable, Sortable;

    protected $table = 'blog_tags';

    protected array $slugs = [
        'slug' => 'name',
    ];

    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'blog_tag_post', 'tag_id', 'post_id');
    }
}
