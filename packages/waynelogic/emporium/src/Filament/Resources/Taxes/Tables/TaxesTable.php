<?php

namespace Waynelogic\Emporium\Filament\Resources\Taxes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleActiveColumn;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleDefaultColumn;

class TaxesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название'),
                TextColumn::make('percent')
                    ->label('Процент')
                    ->suffix('%'),
                ToggleActiveColumn::make(),
                ToggleDefaultColumn::make(),
                ToggleColumn::make('is_global')
                    ->label('Глобальный'),
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
