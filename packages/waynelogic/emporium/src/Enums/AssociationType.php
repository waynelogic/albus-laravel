<?php

namespace Waynelogic\Emporium\Enums;

use Filament\Support\Contracts\HasLabel;

enum AssociationType : string implements HasLabel
{
    case RECOMMENDED = 'recommended';        // Рекомендуемые товары
    case SIMILAR = 'similar';                // Похожие товары
    case COMPLEMENTARY = 'complementary';    // Дополняющие товары
    case FREQUENTLY_BOUGHT_TOGETHER = 'frequently_bought_together'; // Часто покупают вместе
    case ACCESSORY = 'accessory';            // Аксессуары к товару
    case REPLACEMENT = 'replacement';        // Замена / аналоги
    case CROSS_SELL = 'cross_sell';          // Перекрёстные продажи
    case UP_SELL = 'up_sell';                // Апселлинг (более дорогие аналоги)

    /**
     * Получить человеко-читаемое название ассоциации
     */
    public function getLabel(): string
    {
        return match($this) {
            self::RECOMMENDED => 'Рекомендуемые',
            self::SIMILAR => 'Похожие',
            self::COMPLEMENTARY => 'Дополняющие',
            self::FREQUENTLY_BOUGHT_TOGETHER => 'Часто покупают вместе',
            self::ACCESSORY => 'Аксессуары',
            self::REPLACEMENT => 'Аналоги / Замена',
            self::CROSS_SELL => 'Перекрёстные продажи',
            self::UP_SELL => 'Повышение стоимости',
        };
    }

    /**
     * Получить описание ассоциации (опционально)
     */
    public function getDescription(): string
    {
        return match($this) {
            self::RECOMMENDED => 'Товары, которые мы рекомендуем на основе популярности или персонализации.',
            self::SIMILAR => 'Товары, похожие по характеристикам, категории или назначению.',
            self::COMPLEMENTARY => 'Товары, которые дополняют основной продукт.',
            self::FREQUENTLY_BOUGHT_TOGETHER => 'Товары, которые часто покупают вместе с этим.',
            self::ACCESSORY => 'Аксессуары, совместимые с данным товаром.',
            self::REPLACEMENT => 'Аналоги или заменители данного товара.',
            self::CROSS_SELL => 'Сопутствующие товары для увеличения среднего чека.',
            self::UP_SELL => 'Более дорогие или улучшенные версии товара.',
        };
    }
}
