<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\EmptyState;
use Filament\Schemas\Components\Group;
use Filament\Support\Icons\Heroicon;
use Waynelogic\Emporium\Filament\Resources\Warehouses\WarehouseResource;
use Waynelogic\Emporium\Models\Warehouse;

class StocksForm extends Group
{

    public static function make(array|Closure $schema = []): static
    {
        return parent::make($schema);
    }

    public function product($product_id): static
    {
        $count = Warehouse::count();
        if ($count === 0) {
            $this->schema([
                EmptyState::make('Нет ни одного склада')
                    ->description('Для ведения складского учета в системе должен быть заведен хотя бы один склад.')
                    ->icon(Heroicon::OutlinedInboxStack)
                    ->footer([
                        Action::make('addWarehouse')
                            ->label('Добавить склад')
                            ->icon(Heroicon::Plus)
                            ->url(WarehouseResource::getUrl('create')),
                    ]),
            ]);
        } elseif ($count === 1){
            $this->schema([
                Group::make([
                    Hidden::make('product_id')
                        ->default($product_id),
                    TextInput::make('quantity')
                        ->label('Количество')
                        ->prefixIcon(Heroicon::OutlinedPencilSquare)
                        ->numeric()
                        ->required(),
                ])->relationship('main_stock')
            ]);
        } else {
            $this->schema([
                Repeater::make('stocks')
                    ->hiddenLabel()
                    ->table([
                        TableColumn::make('Склад'),
                        TableColumn::make('Остаток'),
                    ])
                    ->schema([
                        Select::make('warehouse_id')
                            ->label('Склад')
                            ->prefixIcon(Heroicon::OutlinedInboxStack)
                            ->relationship('warehouse', 'name')
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->required(),
                        Hidden::make('product_id')
                            ->default($product_id),
                        TextInput::make('quantity')
                            ->label('Количество')
                            ->prefixIcon(Heroicon::OutlinedPencilSquare)
                            ->numeric()
                            ->required(),
                    ])
                    ->addAction(function (Action $action) {
                        $action->label('Добавить склад')->icon(Heroicon::OutlinedInboxStack);
                    })
                    ->relationship('stocks')
            ]);
        }
        return $this;
    }
}
