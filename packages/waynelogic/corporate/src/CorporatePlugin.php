<?php

namespace Waynelogic\Corporate;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Waynelogic\Corporate\Filament\Resources\Partners\PartnerResource;

class CorporatePlugin implements Plugin
{

    public function getId(): string
    {
        return 'corporate';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(in: __DIR__ . '/Filament/Resources', for: 'Waynelogic\Corporate\Filament\Resources')
        ;
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
