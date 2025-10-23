<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Posts;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\Pages\CreatePost;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\Pages\EditPost;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\Pages\ListPosts;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\Schemas\PostForm;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\Tables\PostsTable;
use Waynelogic\FilamentBlog\Models\Post;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | UnitEnum | null $navigationGroup = 'Блог';

    protected static ?string $label = 'Запись';

    protected static ?string $pluralLabel = 'Записи';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
