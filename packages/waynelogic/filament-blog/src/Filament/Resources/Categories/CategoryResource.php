<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Categories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages\CreateCategory;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages\EditCategory;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages\ListCategories;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages\ViewCategory;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Schemas\CategoryForm;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Schemas\CategoryInfolist;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\Tables\CategoriesTable;
use Waynelogic\FilamentBlog\Models\Category;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string | UnitEnum | null $navigationGroup = 'Блог';

    protected static ?string $label = 'Категория';

    protected static ?string $pluralLabel = 'Категории';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::RectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
