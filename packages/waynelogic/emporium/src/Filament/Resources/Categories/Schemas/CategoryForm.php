<?php

namespace Waynelogic\Emporium\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
use Waynelogic\Emporium\Filament\Forms\Components\ToggleActive;
use Waynelogic\Emporium\Filament\Forms\Components\UuidInput;
use Waynelogic\Emporium\Models\Category;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Group::make()->schema([

                Section::make('Основное')->schema([

                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon('heroicon-o-tag')
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                        ->required(),
                    TextInput::make('slug')
                        ->prefixIcon('heroicon-o-link')
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Category::class, 'slug', ignoreRecord: true),

                    Textarea::make('preview_text')
                        ->label('Краткое описание')
                        ->columnSpanFull(),
                ])->columns(2),

                RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Section::make('Картинки')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('icon')
                            ->label('Иконка')
                            ->collection('category_icons')
                            ->imageEditor()
                            ->acceptedFileTypes(['image/*']),
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Обложка')
                            ->collection('category_covers')
                            ->imageEditor()
                            ->acceptedFileTypes(['image/*']),
                    ])
                    ->collapsible()->columns(2),
            ])->columnSpan(['lg' => 2]),

            Group::make()->schema([

                Section::make('Дополнительное')->schema([
                    ToggleActive::make(),
                    // TODO: не добавлять себя
                    Select::make('parent_id')
                        ->label('Родительская категория')
                        ->native(false)
                        ->prefixIcon('heroicon-o-arrow-uturn-up')
                        ->relationship('parent', 'name'),
                    UuidInput::make(),
                ]),

                CreatedUpdatedPlaceholder::make(),

            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }
}
