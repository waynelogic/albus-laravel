<?php

namespace Waynelogic\FilamentBlog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentBlogServiceProvider extends PackageServiceProvider
{

    public static string $name = 'filament-blog';
    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->runsMigrations()
            ->discoversMigrations();
    }
}
