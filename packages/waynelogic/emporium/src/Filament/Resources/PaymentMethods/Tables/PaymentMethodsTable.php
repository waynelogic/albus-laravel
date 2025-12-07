<?php

namespace Waynelogic\Emporium\Filament\Resources\PaymentMethods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleActiveColumn;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleDefaultColumn;

class PaymentMethodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Код')
                    ->searchable(),
                ToggleActiveColumn::make(),
                TextColumn::make('provider')
                    ->label('Провайдер')
                    ->searchable(),
                ToggleDefaultColumn::make(),
                ...CreatedUpdatedColumns::make(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
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
