<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\EmptyState;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Support\RawJs;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Filament\Forms\Components\BundleItemsForm;
use Waynelogic\Emporium\Filament\Forms\Components\DeliveryForm;
use Waynelogic\Emporium\Filament\Forms\Components\PricesForm;
use Waynelogic\Emporium\Filament\Forms\Components\StocksForm;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Filament\Resources\Products\Tables\ProductsTable;
use Waynelogic\Emporium\Filament\Resources\Warehouses\WarehouseResource;
use Waynelogic\Emporium\Models\Offer;
use Waynelogic\Emporium\Models\PriceType;
use Waynelogic\Emporium\Models\Warehouse;

class OfferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([
                Section::make('Основное')->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon(Heroicon::OutlinedTag)
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')
                        ->label('Слаг')
                        ->prefixIcon(Heroicon::OutlinedLink)
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Offer::class, 'slug', ignoreRecord: true),
                    RichEditor::make('description')
                        ->label('Описание')
                        ->extraInputAttributes(['style' => 'min-height: 8rem; max-height: 50vh; overflow-y: auto;'])
                        ->columnSpanFull(),
                ])->columns(2)->compact(),

                Tabs::make()->tabs([
                    Tabs\Tab::make('Основное')
                        ->icon(Heroicon::OutlinedCubeTransparent)
                        ->schema([
                            Fieldset::make('Коды')->schema([
                                TextInput::make('code')
                                    ->prefixIcon('heroicon-o-cube-transparent')
                                    ->label('Внутренний код')
                                    ->unique(Offer::class, 'code', ignoreRecord: true)
                                    ->helperText(str('**Код** в программе учета.')->inlineMarkdown()->toHtmlString())
                                    ->maxLength(255),
                                TextInput::make('sku')
                                    ->prefixIcon('heroicon-o-link')
                                    ->label('Артикул')
                                    ->helperText(str('**SKU** (Stock Keeping Unit)')->inlineMarkdown()->toHtmlString())
                                    ->unique(Offer::class, 'sku', ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('barcode')
                                    ->prefixIcon('heroicon-o-qr-code')
                                    ->label('Штрих-код')
                                    ->helperText(str('**Barcode** (ISBN, UPC, GTIN, etc.)')->inlineMarkdown()->toHtmlString())
                                    ->unique(Offer::class, 'barcode', ignoreRecord: true)
                                    ->maxLength(255),
                            ])->columns(3)->columnSpanFull(),
                        ]),
                    Tabs\Tab::make('Доставка')
                        ->icon(Heroicon::OutlinedTruck)
                        ->schema([
                            DeliveryForm::make(),
                        ]),
                    Tabs\Tab::make('Цены')
                        ->icon(Heroicon::OutlinedCurrencyDollar)
                        ->schema([
                            PricesForm::make(),
                        ]),
                    Tabs\Tab::make('Остатки')
                        ->icon(Heroicon::OutlinedInboxStack)
                        ->schema([
                            StocksForm::make()->product($schema->model->product_id),
                        ]),
                ]),

                Section::make('Картинки')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('offer_gallery')
                            ->multiple()
                            ->imageEditor()
                            ->acceptedFileTypes(['image/*'])
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

            ])->columnSpan(['lg' => 2]),

            Group::make([
                Section::make('Связи')->schema([
                    UuidInput::make(),
                    ModalTableSelect::make('product_id')
                        ->label('Товар')
                        ->tableConfiguration(ProductsTable::class)
                        ->relationship('product', 'name')
                        ->required(),
                    ToggleActive::make()->helperText('Включить или выключить этот продукт.'),
                ]),
            ]),

        ])->columns(['lg' => 3]);
    }
}
