<?php

namespace Waynelogic\Emporium\Filament\Resources\Currencies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleActiveColumn;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleDefaultColumn;
use Waynelogic\Emporium\Filament\Tables\Columns\UuidColumn;

class CurrenciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                UuidColumn::make(),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Код')
                    ->searchable(),
                ToggleActiveColumn::make(),
                TextColumn::make('number')
                    ->label('Номер')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('symbol')
                    ->label('Символ')
                    ->searchable(),
                ToggleDefaultColumn::make(),
                TextColumn::make('rate')
                    ->label('Курс')
                    ->numeric()
                    ->sortable(),
                ...CreatedUpdatedColumns::make(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
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
