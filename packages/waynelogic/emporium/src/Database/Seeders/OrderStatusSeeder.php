<?php

namespace Waynelogic\Emporium\Database\Seeders;

use Illuminate\Database\Seeder;
use Waynelogic\Emporium\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::query()->firstOrCreate([
            'name' => 'Новый',
            'code' => 'new',
            'color' => 'info',
            'is_default' => true,
            'sort_order' => 1,
        ]);

        OrderStatus::query()->firstOrCreate([
            'name' => 'Аванс',
            'code' => 'prepayment',
            'color' => 'warning',
            'sort_order' => 2,
        ]);

        OrderStatus::query()->firstOrCreate([
            'name' => 'В работе',
            'code' => 'in_work',
            'color' => 'success',
            'sort_order' => 3,
        ]);

        OrderStatus::query()->firstOrCreate([
            'name' => 'Завершен',
            'code' => 'complete',
            'color' => 'gray',
            'is_complete' => true,
            'sort_order' => 4,
        ]);
        OrderStatus::query()->firstOrCreate([
            'name' => 'Отменен',
            'code' => 'canceled',
            'color' => 'danger',
            'is_cancel' => true,
            'is_complete' => true,
            'sort_order' => 5,
        ]);
    }
}
