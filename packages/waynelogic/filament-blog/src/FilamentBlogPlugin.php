<?php namespace Waynelogic\FilamentBlog;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\CategoryResource;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\PostResource;
use Waynelogic\FilamentCms\FilamentCmsPlugin;

class FilamentBlogPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-blog';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(in: __DIR__ . '/Filament/Resources', for: 'Waynelogic\FilamentBlog\Filament\Resources');
    }

    public function boot(Panel $panel): void
    {
    }
}
