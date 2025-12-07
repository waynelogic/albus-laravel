<?php

namespace Waynelogic\Emporium\Filament\Resources\Offers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\UuidColumn;

class OffersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                UuidColumn::make(),
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
                TextColumn::make('quantity')
                    ->label('Количество'),
                IconColumn::make('is_active')
                    ->label('Активность')
                    ->boolean(),
                TextColumn::make('product.name')
                    ->label('Товар')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ...CreatedUpdatedColumns::make(),
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
