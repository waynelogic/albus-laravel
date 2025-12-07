<?php

namespace Waynelogic\Emporium\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\Emporium\Filament\Forms\Components\CreatedUpdatedPlaceholder;
use Waynelogic\Emporium\Filament\Forms\Components\ImageUpload;
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Brand;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([

                Section::make('Основное')->schema([

                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon('heroicon-o-tag')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')
                        ->label('Слаг')
                        ->prefixIcon('heroicon-o-link')
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Brand::class, 'slug', ignoreRecord: true),

                ])->columns(2),

                Textarea::make('preview_text')
                    ->label('Краткое описание')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Group::make([
                    ImageUpload::make('brand_logo')
                        ->label('Логотип'),
                    ImageUpload::make('brand_cover')
                        ->label('Обложка'),
                ])->columns(2),

            ])->columnSpan(['lg' => 2]),

            Group::make()->schema([

                Section::make('Дополнительное')->schema([
                    ToggleActive::make(),
                    UuidInput::make(),
                    TextInput::make('website')
                        ->label('Ссылка на сайт')
                        ->url()
                        ->prefixIcon('heroicon-o-globe-alt'),
                ]),

                CreatedUpdatedPlaceholder::make(),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }
}
