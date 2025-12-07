<?php

namespace Waynelogic\Emporium\Filament\Resources\Products\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Waynelogic\Emporium\Models\Product;
use Waynelogic\Emporium\Models\Stock;

class ProductStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Всего товаров', Product::count()),
            Stat::make('Остатки', Stock::sum('quantity')),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
