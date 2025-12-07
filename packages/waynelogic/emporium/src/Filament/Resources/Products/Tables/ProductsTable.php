<?php

namespace Waynelogic\Emporium\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\UuidColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                UuidColumn::make(),
                SpatieMediaLibraryImageColumn::make('gallery')
                    ->label('Картинка')
                    ->collection('product-gallery')->limit(1),
                TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('main_price.price')
                    ->label('Цена')
                    ->money('RUB'),
                TextColumn::make('main_stock.quantity')
                    ->label('Остаток')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Категория')
                    ->badge()
                    ->sortable(),
                TextColumn::make('brand.name')
                    ->label('Изготовитель')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('country.name')
                    ->label('Страна')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Активность')
                    ->boolean(),
                TextColumn::make('is_active')
                    ->label('Активность')
                    ->state(fn ($record): string => $record->is_published ? 'Опубликован' : 'Не опубликован')
                    ->weight(FontWeight::Medium)
                    ->description(fn ($record): string => $record->published_at->format('d M Y - H:i')),
                TextColumn::make('product_type.name')
                    ->label('Тип')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ...CreatedUpdatedColumns::make(),
            ])
            ->groups([
                Group::make('product_type.name')
                    ->label('Тип')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
