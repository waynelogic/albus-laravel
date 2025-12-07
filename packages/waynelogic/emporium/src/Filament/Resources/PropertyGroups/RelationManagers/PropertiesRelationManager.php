<?php

namespace Waynelogic\Emporium\Filament\Resources\PropertyGroups\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Properties\PropertyResource;

class PropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    protected static ?string $relatedResource = PropertyResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ])
            ->reorderable('sort_order');
    }
}
