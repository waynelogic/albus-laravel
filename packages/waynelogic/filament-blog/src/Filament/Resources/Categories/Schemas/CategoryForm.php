<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Categories\Schemas;

use Exception;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Waynelogic\FilamentBlog\Models\Category;

class CategoryForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make([
                Section::make('Основное')->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->prefixIcon('heroicon-o-tag')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->label('Ссылка')
                        ->prefixIcon('heroicon-o-link')
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Category::class, 'slug', ignoreRecord: true),
                ])->columns(2)->columnSpanFull(),

                Textarea::make('preview_text')
                    ->label('Короткое описание')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

            ])->columnSpan(['lg' => 2]),

            Group::make([
                Section::make('Параметры')->schema([
                    TextInput::make('external_id')->label('Внешний идентификатор')
                        ->prefixIcon('heroicon-o-clipboard')
                        ->mask('********-****-****-****-************'),

                    Select::make('parent_id')
                        ->label('Родительская категория')
                        ->prefixIcon('heroicon-o-rectangle-group')
                        ->relationship('parent', 'name'),

                    Toggle::make('is_active')
                        ->label('Активность')
                        ->onIcon('heroicon-s-power')
                        ->default(true)
                        ->required(),
                ]),
            ]),

        ])->columns(['lg' => 3,]);
    }
}
