<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Tags;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\Pages\CreateTag;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\Pages\EditTag;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\Pages\ListTags;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\Schemas\TagForm;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\Tables\TagsTable;
use Waynelogic\FilamentBlog\Models\Tag;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $label = 'Тег';

    protected static ?string $pluralLabel = 'Теги';

    protected static string | UnitEnum | null $navigationGroup = 'Блог';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::Tag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
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
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
