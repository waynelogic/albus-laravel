<?php

namespace Waynelogic\Emporium\Filament\Resources\Products\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Throwable;
use Waynelogic\Emporium\Enums\ProductKind;
use Waynelogic\Emporium\Filament\Resources\Products\ProductResource;
use Waynelogic\Emporium\Filament\Resources\Products\Widgets\ProductStats;
use Waynelogic\Emporium\Models\Product;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ProductStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modal()->createAnother(false)->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon(Heroicon::OutlinedTag)
                        ->maxLength(255)
                        ->required(),
                    Select::make('product_type_id')
                        ->prefixIcon(Heroicon::OutlinedCircleStack)
                        ->label('Вид продукта')
                        ->relationship('product_type', 'name')
                        ->preload()
                        ->native(false)
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Название')
                                ->prefixIcon(Heroicon::OutlinedInboxStack)
                                ->maxLength(255)
                                ->required(),
                        ])
                        ->required(),
                ]),
            ])->using(fn (array $data, string $model) => static::createRecord($data))
                ->successRedirectUrl(fn (Product $record): string => ProductResource::getUrl('edit', ['record' => $record,])),
        ];
    }

    /**
     * @throws Throwable
     */
    public static function createRecord(array $data): Product
    {
        DB::beginTransaction();
        $product = Product::create([
            'name' => $data['name'],
            'product_type_id' => $data['product_type_id'],
        ]);
        $product->offers()->create([
            'name' => $data['name'],
        ]);
//        if ($kind != ProductKind::Variable) {
//        }
        DB::commit();

        return $product;
    }

    protected Width | string | null $maxContentWidth = Width::Full;
}
