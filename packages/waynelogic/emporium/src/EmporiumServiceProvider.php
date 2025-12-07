<?php namespace Waynelogic\Emporium;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Waynelogic\Emporium\Console\Commands\EmporiumInstall;
use Waynelogic\Emporium\Filament\Resources\Currencies\CurrencyResource;
use Waynelogic\Emporium\Filament\Resources\OrderStatuses\OrderStatusResource;
use Waynelogic\Emporium\Filament\Resources\Organizations\OrganizationResource;
use Waynelogic\Emporium\Filament\Resources\PaymentMethods\PaymentMethodResource;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\PriceTypeResource;
use Waynelogic\Emporium\Filament\Resources\ShippingTypes\ShippingTypeResource;
use Waynelogic\Emporium\Filament\Resources\Taxes\TaxResource;
use Waynelogic\Emporium\Filament\Resources\Units\UnitResource;

class EmporiumServiceProvider extends PackageServiceProvider
{
    public static string $name = 'emporium';

    public function configurePackage(Package $package): void
    {
        $package->name(self::$name)
            ->hasViews()
            ->runsMigrations()
            ->discoversMigrations()
            ->hasCommand(
                EmporiumInstall::class
            );
    }
}
