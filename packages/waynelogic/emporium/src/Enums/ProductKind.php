<?php

namespace Waynelogic\Emporium\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

enum ProductKind : string implements HasLabel, HasIcon, HasColor
{
    case Simple = 'simple';
    case Variable = 'variable';
    case Bundle = 'bundle';


    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Simple => 'Простой',
            self::Variable => 'Вариативный',
            self::Bundle => 'Комплект',
        };
    }

    public function getIcon(): string|BackedEnum|null
    {
        return match ($this) {
            self::Simple => Heroicon::OutlinedCubeTransparent,
            self::Variable => Heroicon::OutlinedSquaresPlus,
            self::Bundle => Heroicon::OutlinedSquare2Stack,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Simple => 'success',
            self::Variable => 'warning',
            self::Bundle => 'info',
        };
    }
}
