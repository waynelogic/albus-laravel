<?php

namespace Waynelogic\EmporiumEnterprise;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EmporiumEnterpriseServiceProvider extends PackageServiceProvider
{
    public static string $packageName = 'emporium-enterprise';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$packageName)
            ->hasConfigFile()
            ->hasRoute('api');
    }
}
