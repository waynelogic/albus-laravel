<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('external_id'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
