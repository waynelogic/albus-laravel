<?php namespace Waynelogic\Emporium\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AttributeType : string implements HasLabel, HasColor, HasIcon
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case BOOLEAN = 'boolean';
    case DROPDOWN = 'dropdown';
    case LIST = 'list';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TEXT => 'Текст',
            self::NUMBER => 'Число',
            self::BOOLEAN => 'Да/Нет',
            self::DROPDOWN => 'Выпадающий список',
            self::LIST => 'Список',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::TEXT => 'info',
            self::NUMBER => 'success',
            self::BOOLEAN => 'warning',
            self::DROPDOWN => 'danger',
            self::LIST => 'gray',
        };
    }

    public static function enterprise($value)
    {
        return match ($value) {
            'Строка' => self::TEXT,
            'Число' => self::NUMBER,
            'Булево' => self::BOOLEAN,
            'Справочник' => self::DROPDOWN,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TEXT => 'heroicon-o-pencil',
            self::NUMBER => 'heroicon-o-pencil',
            self::BOOLEAN => 'heroicon-o-pencil',
            self::DROPDOWN => 'heroicon-o-pencil',
            self::LIST => 'heroicon-o-pencil',
        };
    }
}
