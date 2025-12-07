<?php

namespace Waynelogic\Emporium\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Enums\ProductKind;
use Waynelogic\Emporium\Filament\Forms\Components\DeliveryForm;
use Waynelogic\Emporium\Filament\Forms\Components\ImageUpload;
use Waynelogic\Emporium\Filament\Forms\Components\PricesForm;
use Waynelogic\Emporium\Filament\Forms\Components\PropertiesForm;
use Waynelogic\Emporium\Filament\Forms\Components\StocksForm;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Product;
use Waynelogic\Emporium\Models\Unit;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        $obProductType = $schema->model->product_type ?? null;
        $arOffers = $schema->model->offers()->get();
        $arProperties = $obProductType?->properties ?? null;

        return $schema->components([
            Group::make([
                ...self::getMainInfoPanel(),

                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make('Основное')
                        ->icon(Heroicon::OutlinedCubeTransparent)
                        ->iconPosition(IconPosition::After)
                        ->schema([
                            Fieldset::make('Коды')->schema([
                                TextInput::make('code')
                                    ->prefixIcon(Heroicon::OutlinedCubeTransparent)
                                    ->label('Внутренний код')
                                    ->unique(Product::class, 'code', ignoreRecord: true)
                                    ->helperText(str('**Код** в программе учета.')->inlineMarkdown()->toHtmlString())
                                    ->maxLength(255),
                                TextInput::make('sku')
                                    ->prefixIcon(Heroicon::OutlinedLink)
                                    ->label('Артикул')
                                    ->helperText(str('**SKU** (Stock Keeping Unit)')->inlineMarkdown()->toHtmlString())
                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('barcode')
                                    ->prefixIcon(Heroicon::OutlinedQrCode)
                                    ->label('Штрих-код')
                                    ->helperText(str('**Barcode** (ISBN, UPC, GTIN, etc.)')->inlineMarkdown()->toHtmlString())
                                    ->unique(Product::class, 'barcode', ignoreRecord: true)
                                    ->maxLength(255),
                            ])->columns(3)->columnSpanFull(),

                            Fieldset::make('Настройки')->schema([
                                Toggle::make('backorder')
                                    ->label('Товар может быть возвращен в магазин'),
                                Toggle::make('is_virtual')
                                    ->label('Товар виртуальный')
                                    ->live()
                                    ->onIcon(Heroicon::OutlinedCubeTransparent),
                            ])->columns(2),
                        ]),
                    Tabs\Tab::make('Свойства')
                        ->schema([
                            PropertiesForm::make()->properties($arProperties)->columns(2),
                        ])
                        ->hidden(fn() => $arProperties->isEmpty()),
//                    Tabs\Tab::make('Доставка')
//                        ->icon(Heroicon::OutlinedTruck)
//                        ->schema([
//                            DeliveryForm::make()->relationship('offer'),
//                        ])->hidden(fn(Product $record, Get $get) => $record->kind != ProductKind::Simple || $get('is_virtual')),
//                    Tabs\Tab::make('Цены')
//                        ->icon(Heroicon::OutlinedCurrencyDollar)
//                        ->iconPosition(IconPosition::After)
//                        ->schema([
//                            PricesForm::make()->relationship('offer'),
//                        ])->hidden(fn(Product $record) => $record->kind != ProductKind::Simple),
//                    Tabs\Tab::make('Остатки')
//                        ->icon(Heroicon::OutlinedInboxStack)
//                        ->iconPosition(IconPosition::After)
//                        ->schema([
//                            StocksForm::make()->product($schema->model->id)->model($schema->model->offer),
//                        ])->hidden(fn(Product $record) => $record->kind != ProductKind::Simple),
                ]),

                Section::make('Картинки')
                    ->schema([
                        ImageUpload::make('product-gallery')
                            ->multiple()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ])->columnSpan(['lg' => 2]),

            self::getAsidePanel(),
        ])->columns(['lg' => 3]);
    }

    public static function getMainInfoPanel(): array
    {
        return [
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
                    ->unique(Product::class, 'slug', ignoreRecord: true),
                RichEditor::make('description')
                    ->label('Описание')
                    ->extraInputAttributes(['style' => 'min-height: 8rem; overflow-y: auto;'])
                    ->columnSpanFull(),
            ])->columns(2)->compact(),
        ];
    }

    public static function getAsidePanel()
    {
        return Group::make([
            Section::make('Параметры')->schema([
//                ToggleButtons::make('kind')
//                    ->label('Тип товара')
//                    ->options(ProductKind::class)
//                    ->grouped()
//                    ->columns(2)
//                    ->required(),
                Select::make('product_type_id')
                    ->prefixIcon('heroicon-o-tag')
                    ->label('Вид продукта')
                    ->relationship('product_type', 'name')
                    ->disabled(fn($record) => $record ?? false)
                    ->preload()
                    ->native(false)
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Название')
                            ->prefixIcon(Heroicon::OutlinedTag)
                            ->maxLength(255)
                            ->required(),
                    ])
                    ->required(),
                DatePicker::make('published_at')
                    ->prefixIcon(Heroicon::OutlinedClock)
                    ->label('Опубликовано')
                    ->default(now()),
                ToggleActive::make('is_published')
                    ->helperText('Включить или выключить этот продукт.'),
            ])->compact(),

            Section::make('Связи')->schema([
                Select::make('category_id')
                    ->prefixIcon(Heroicon::OutlinedRectangleStack)
                    ->label('Категория')
                    ->native(false)
                    ->relationship('category', 'name'),
                Select::make('brand_id')
                    ->prefixIcon(Heroicon::OutlinedBookmarkSquare)
                    ->label('Бренд')
                    ->native(false)
                    ->relationship('brand', 'name'),
                Select::make('country_id')
                    ->prefixIcon('heroicon-o-map')
                    ->label('Страна')
                    ->native(false)
                    ->relationship('country', 'name'),
                Select::make('unit_id')
                    ->prefixIcon('heroicon-o-scale')
                    ->label('Единица измерения')
                    ->relationship('unit', 'name')
                    ->native(false)
                    ->default(fn() => Unit::query()->where('is_default', true)->first()->id ?? null),
                UuidInput::make(),

            ])->compact(),
        ]);
    }
}
