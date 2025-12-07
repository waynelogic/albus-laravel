<?php

namespace Waynelogic\Emporium\Console\Commands;

use Illuminate\Console\Command;
use Waynelogic\Emporium\Database\Seeders\OrderStatusSeeder;
use Waynelogic\Emporium\Models\Currency;
use Waynelogic\Emporium\Models\PaymentMethod;
use Waynelogic\Emporium\Models\ShippingType;
use Waynelogic\Emporium\Models\Unit;

class EmporiumInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emporium:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Emporium';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate');
        $this->info('Migrations have been run successfully!');

        $this->newLine();
        $this->makeUnits();
        $this->info('Units have been created successfully!');

        $this->newLine();
        $this->call(OrderStatusSeeder::class);
        $this->info('Order statuses have been created successfully!');

        $this->newLine();
        $this->makeShippingType();
        $this->info('Shipping types have been created successfully!');

        $this->newLine();
        $this->makePaymentMethod();
        $this->info('Payment methods have been created successfully!');

        $this->newLine();
        $this->makeCurrency();
        $this->info('Currencies have been created successfully!');
    }
    private function makeUnits(): void
    {
        Unit::query()->updateOrCreate([
            'code' => 796,
        ], [
            'name' => 'Штука',
            'short_name' => 'шт',
            'code' => '796',
            'international_name' => 'PCE',
            'is_default' => true,
        ]);
    }

    private function makeCurrency(): void
    {
        Currency::query()->updateOrCreate([
            'number' => 643,
        ], [
            'name' => 'Российский рубль',
            'code' => 'RUB',
            'number' => 643,
            'symbol' => '₽',
            'is_active' => true,
            'is_default' => true,
        ]);
    }

//    private function makeShippingType(): void
//    {
//        ShippingType::query()->updateOrCreate([
//            'code' => 'self',
//        ], [
//            'name' => 'Самовывоз',
//            'code' => 'self',
//            'is_active' => true,
//            'is_default' => true,
//        ]);
//    }
//
//    private function makePaymentMethod(): void
//    {
//        PaymentMethod::query()->updateOrCreate([
//            'code' => 'cash',
//        ],[
//            'name' => 'Наличные при получении',
//            'code' => 'cash',
//            'is_active' => true,
//            'is_default' => true,
//        ]);
//    }
}
