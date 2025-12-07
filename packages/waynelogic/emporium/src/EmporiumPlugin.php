<?php

namespace Waynelogic\Emporium;

use Filament\Contracts\Plugin;
use Filament\Navigation\NavigationItem;
use Filament\Panel;

class EmporiumPlugin implements Plugin
{
    public bool $registerItems = true;
    public function getId(): string
    {
        return 'emporium';
    }

    public function onlyLink(): self
    {
        $this->registerItems = false;
        return $this;
    }

    public function register(Panel $panel): void
    {
        if ($this->registerItems) {
            $panel->discoverResources(in: __DIR__ . '/Filament/Resources', for: 'Waynelogic\Emporium\Filament\Resources');
        } else {
            $panel->navigationItems([
                NavigationItem::make('Магазин')
                    ->icon('heroicon-o-shopping-cart')
                    ->url('/emporium')
            ]);
        }
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
