<?php

namespace Waynelogic\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Waynelogic\Corporate\Enums\PartnerType;
use Waynelogic\FilamentCms\Database\Traits\Activatable;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Partner extends Model implements HasMedia
{
    use Sortable, Sluggable, Activatable, InteractsWithMedia;

    protected array $slugs = [
        'slug' => 'name',
    ];

    protected $casts = [
        'type' => PartnerType::class,
    ];

    protected $fillable = [
        'name',
        'slug',
        'preview_text',
        'content',
        'web_site',
        'type',
    ];

    public function getLogoUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('partners_logos');
    }
}
