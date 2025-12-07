<?php

namespace Waynelogic\Emporium\Filament\Resources\PriceTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Filament\Tables\Columns\UuidColumn;

class PriceTypesTable
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
                TextColumn::make('code')
                    ->label('Код')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('currency.name')
                    ->label('Валюта')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Активность')
                    ->boolean(),
                ToggleColumn::make('is_default')
                    ->label('По умолчанию')
                    ->sortable(),
                ...CreatedUpdatedColumns::make(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
