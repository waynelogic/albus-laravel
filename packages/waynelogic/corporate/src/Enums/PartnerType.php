<?php

namespace Waynelogic\Corporate\Enums;

use Filament\Support\Contracts\HasLabel;

enum PartnerType: string implements HasLabel
{
    case PARTNER = 'partner';
    case CLIENT = 'client';

    public function getLabel(): string
    {
        return match ($this) {
            self::PARTNER => 'Партнер',
            self::CLIENT => 'Клиент',
        };
    }
}
