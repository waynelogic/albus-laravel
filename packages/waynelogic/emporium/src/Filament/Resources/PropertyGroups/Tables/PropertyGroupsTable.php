<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\AttributeGroups\AttributeGroupResource;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;

class PropertyGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('handle')
                    ->label('Handle')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('attributes_count')
                    ->label('Кол. свойств')
                    ->counts('properties')
                    ->sortable(),
                TextColumn::make('holder_class')
                    ->label('Модель')
//                    ->formatStateUsing(function ($state) {
//                        return AttributeGroupResource::getAttributableTypes()[$state];
//                    })
                    ->searchable()
                    ->sortable(),
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
