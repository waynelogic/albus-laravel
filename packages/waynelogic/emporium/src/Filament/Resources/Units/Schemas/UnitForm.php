<?php

namespace Waynelogic\Emporium\Filament\Resources\Units\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleDefault;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')
                ->label('Наименование')
                ->prefixIcon('heroicon-o-tag')
                ->required(),
            Forms\Components\TextInput::make('short_name')
                ->label('Сокращенное наим.')
                ->prefixIcon('heroicon-o-link')
                ->required(),
            Forms\Components\TextInput::make('international_name')
                ->label('Международное наим.')
                ->prefixIcon('heroicon-o-globe-alt'),
            Forms\Components\TextInput::make('code')
                ->label('Код')
                ->prefixIcon('heroicon-o-qr-code')
                ->required(),
            ToggleDefault::make(),
        ]);
    }
}
