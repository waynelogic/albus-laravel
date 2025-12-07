<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\EmptyState;
use Filament\Schemas\Components\Group;
use Filament\Support\Icons\Heroicon;
use Waynelogic\Emporium\Filament\Resources\PriceTypes\PriceTypeResource;
use Waynelogic\Emporium\Models\PriceType;

class PricesForm extends Group
{
    public static function make(array|Closure $schema = []): static
    {
        $arPriceTypes = PriceType::query()->select(['is_default'])->get();
        if ($arPriceTypes->count() === 0) {
            $component = EmptyState::make('Нет ни одного вида цен')
                ->description('Для ведения учета цен в системе должен быть заведен хотя бы один вид цен.')
                ->icon(Heroicon::OutlinedArrowUpOnSquareStack)
                ->footer([
                    Action::make('addWarehouse')
                        ->label('Добавить вид цены')
                        ->icon(Heroicon::Plus)
                        ->url(PriceTypeResource::getUrl('create')),
                ]);
        } elseif ($arPriceTypes->count() === 1) {
            $component = Group::make([
                TextInput::make('price')
                    ->label('Цена')
                    ->prefixIcon(Heroicon::OutlinedCube)
                    ->numeric()
                    ->inputMode('decimal')
                    ->required(),
                TextInput::make('old_price')
                    ->label('Старая цена')
                    ->prefixIcon(Heroicon::OutlinedCubeTransparent)
                    ->numeric()
                    ->inputMode('decimal'),
            ])
                ->columns(2)
                ->relationship('main_price');
        } else {
            $component = Repeater::make('prices')->hiddenLabel()
                ->table([
                    TableColumn::make('Тип цены'),
                    TableColumn::make('Цена'),
                ])
                ->schema([
                    Select::make('price_type_id')
                        ->relationship('price_type', 'name')
                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                        ->required(),
                    TextInput::make('price')
                        ->label('Цена')
                        ->prefixIcon(Heroicon::OutlinedCube)
                        ->numeric()
                        ->inputMode('decimal')
                        ->required(),
                    TextInput::make('old_price')
                        ->label('Старая цена')
                        ->prefixIcon(Heroicon::OutlinedCubeTransparent)
                        ->numeric()
                        ->inputMode('decimal'),
                ])
                ->columns(2)
                ->relationship('prices')
                ->addActionLabel('Добавить цену');
        }
        return parent::make([$component]);
    }
}
