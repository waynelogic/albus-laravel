<?php

namespace Waynelogic\Emporium\Filament\Resources\Countries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;

class CountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('currency.name')
                    ->label('Валюта')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('iso')
                    ->label('Код')
                    ->searchable(),
                TextColumn::make('phone_code')
                    ->label('Код телефона')
                    ->searchable(),
                TextColumn::make('capital')
                    ->label('Столица')
                    ->searchable(),
                TextColumn::make('lang')
                    ->label('Язык')
                    ->searchable(),
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
