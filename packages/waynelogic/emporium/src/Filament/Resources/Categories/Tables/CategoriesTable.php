<?php

namespace Waynelogic\Emporium\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Tables\Columns\CreatedUpdatedColumns;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('external_id')
                    ->label('Внешний ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order'),
                TextColumn::make('parent_id'),
                SpatieMediaLibraryImageColumn::make('icon')
                    ->label('Обложка')
                    ->collection('category_icons')
                    ->wrap(),
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Активность'),
                TextColumn::make('parent.name')
                    ->label('Родительская категория')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                ...CreatedUpdatedColumns::make(),
            ])
//            ->modifyQueryUsing(
//                fn($query, $table) => $table->isReordering() ? $query->where('parent_id', null) : $query
//            )
//            ->query(function ($component, $table, $query)  {
//                $isReordering = $table->isReordering();
//                dd($query);
//                if ($isReordering) {
//                    return $query;
//                } else {
//                    $query->where('parent_id', null);
//                }
//            })
            ->reorderable('sort_order')
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
