<?php

namespace Waynelogic\Emporium\Filament\Resources\Reviews;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Waynelogic\Emporium\Filament\Resources\Reviews\Pages\CreateReview;
use Waynelogic\Emporium\Filament\Resources\Reviews\Pages\EditReview;
use Waynelogic\Emporium\Filament\Resources\Reviews\Pages\ListReviews;
use Waynelogic\Emporium\Filament\Resources\Reviews\Schemas\ReviewForm;
use Waynelogic\Emporium\Filament\Resources\Reviews\Tables\ReviewsTable;
use Waynelogic\Emporium\Models\Review;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $pluralLabel = 'Отзывы';

    protected static ?string $label = 'Отзыв';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string | BackedEnum | null $activeNavigationIcon = Heroicon::Star;

    public static function form(Schema $schema): Schema
    {
        return ReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReviewsTable::configure($table);
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
            'index' => ListReviews::route('/'),
            'create' => CreateReview::route('/create'),
            'edit' => EditReview::route('/{record}/edit'),
        ];
    }
}
