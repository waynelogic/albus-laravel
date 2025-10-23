<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Waynelogic\FilamentBlog\Models\Post;

class PostForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([

                Section::make('Основное')->schema([
                    TextInput::make('title')
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
                        ->unique(Post::class, 'slug', ignoreRecord: true),
                ])->columns(2)->columnSpanFull()->compact(),

                Textarea::make('preview_text')
                    ->label('Краткий текст')
                    ->required()
                    ->columnSpan('full'),

                RichEditor::make('content')
                    ->label('Контент')
                    ->required()
                    ->columnSpan('full'),

                Section::make('Картинки')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Обложка')
                            ->collection('blog_post_covers')
                            ->disk('public'),
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Галерея')
                            ->collection('blog_post_gallery')
                            ->multiple()
                            ->disk('public'),
                    ])
                    ->collapsible(),

            ])->columnSpan(['xl' => 3]),

            Group::make()->schema([

                Section::make('Параметры')->schema([
                    Select::make('author_id')
                        ->label('Автор')
                        ->prefixIcon(Heroicon::User)
                        ->relationship('author', 'name')
                        ->native(false)
                        ->preload()
                        ->default(auth()->user()->id)
                        ->searchable()
                        ->required(),

                    Select::make('category_id')
                        ->label('Категория')
                        ->prefixIcon(Heroicon::RectangleStack)
                        ->relationship('category', 'name')
                        ->native(false)
                        ->preload()
                        ->searchable()
                        ->required(),

                    Toggle::make('is_published')
                        ->label('Показывать')
                        ->onIcon('heroicon-s-power')
                        ->default(true)
                        ->required(),
                    DateTimePicker::make('published_at')
                        ->label('Дата публикации')
                        ->prefixIcon(Heroicon::Calendar)
                        ->default(now())
                        ->required(),

                    Select::make('tags')
                        ->label('Теги')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->native(false)
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->preload(),
                ]),
            ]),

        ])->columns(['xl' => 4,]);
    }
}
