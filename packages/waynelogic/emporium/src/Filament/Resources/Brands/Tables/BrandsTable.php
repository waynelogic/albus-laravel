<?php

namespace Waynelogic\Emporium\Filament\Resources\Brands\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;
use Waynelogic\Emporium\Models\Brand;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('external_id')
                    ->label('Внешний ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')
                    ->label('Наименование')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Слаг')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('website')
                    ->label('Сайт')
                    ->copyableState(fn (Brand $record): string => "URL: {$record->website}")
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
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
