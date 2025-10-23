<?php

namespace Waynelogic\Corporate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CorporateServiceProvider extends PackageServiceProvider
{
    protected static string $name = 'corporate';
    public function configurePackage(Package $package): void
    {
        $package
            ->name(self::$name)
            ->runsMigrations()
            ->discoversMigrations();
    }
}
