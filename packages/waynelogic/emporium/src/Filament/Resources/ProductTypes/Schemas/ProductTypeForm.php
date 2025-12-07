<?php

namespace Waynelogic\Emporium\Filament\Resources\ProductTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\ProductType;

class ProductTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Основное')->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->prefixIcon('heroicon-o-tag')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->prefixIcon('heroicon-o-link')
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(ProductType::class, 'slug', ignoreRecord: true),
                UuidInput::make(),
            ])->columns(3)->columnSpanFull(),

            Section::make('Значения по умолчанию')->schema([
                Select::make('default_brand_id')
                    ->label('Бренд')
                    ->prefixIcon(Heroicon::OutlinedBookmarkSquare)
                    ->relationship('default_brand', 'name')
                    ->preload(),
                Select::make('default_category_id')
                    ->label('Категория')
                    ->prefixIcon(Heroicon::OutlinedRectangleStack)
                    ->relationship('default_category', 'name')
                    ->preload(),
                Select::make('default_country_id')
                    ->label('Страна')
                    ->prefixIcon(Heroicon::OutlinedRectangleStack)
                    ->relationship('default_country', 'name')
                    ->preload(),
                Select::make('default_unit_id')
                    ->label('Единица измерения')
                    ->prefixIcon(Heroicon::OutlinedScale)
                    ->relationship('default_unit', 'name')
                    ->preload(),
            ])->columns(2)->columnSpanFull(),
        ]);
    }
}
