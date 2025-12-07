<?php

namespace Waynelogic\Emporium\Filament\Resources\Units\Tables;

use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\ToggleDefaultColumn;

class UnitsTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Наименование')
                    ->searchable(),
                TextColumn::make('short_name')
                    ->label('Сокр. наим.')
                    ->searchable(),
                TextColumn::make('international_name')
                    ->label('Международное наим.')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Код')
                    ->searchable(),
                ToggleDefaultColumn::make(),
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
