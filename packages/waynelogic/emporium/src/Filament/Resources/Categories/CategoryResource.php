<?php

namespace Waynelogic\Emporium\Filament\Resources\Categories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Waynelogic\Emporium\Filament\Resources\Categories\Pages\CreateCategory;
use Waynelogic\Emporium\Filament\Resources\Categories\Pages\EditCategory;
use Waynelogic\Emporium\Filament\Resources\Categories\Pages\ListCategories;
use Waynelogic\Emporium\Filament\Resources\Categories\RelationManagers\ChildrenRelationManager;
use Waynelogic\Emporium\Filament\Resources\Categories\Schemas\CategoryForm;
use Waynelogic\Emporium\Filament\Resources\Categories\Tables\CategoriesTable;
use Waynelogic\Emporium\Models\Category;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $label = 'Категория';

    protected static ?string $pluralLabel = 'Категории';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = 'Каталог';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|null|BackedEnum $activeNavigationIcon = Heroicon::RectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class
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
