<?php

namespace Waynelogic\Emporium\Filament\Resources\Products\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Waynelogic\Emporium\Enums\AssociationType;
use Waynelogic\Emporium\Filament\Resources\Products\ProductResource;

class AssociationsRelationManager extends RelationManager
{
    protected static string $relationship = 'associations';

    protected static ?string $inverseRelationship = 'associated';

    protected static ?string $relatedResource = ProductResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('type')
                ->options(AssociationType::class),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()->schema(fn (AttachAction $action): array => [
                    $action->getRecordSelect(),
                    Select::make('type')
                        ->label('Тип')
                        ->options(AssociationType::class)
                        ->native(false)
                        ->preload(true)
                        ->required(),
                ])
            ]);
    }
}
