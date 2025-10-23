<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Posts\Tables;

use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class PostsTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
//        $table->id();
//        $table->foreignId('author_id')->nullable()->constrained('backend_users')->nullOnDelete();
//        $table->foreignId('category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
//        $table->string('title')->index();
//        $table->slug();
//        $table->mediumText('metadata')->nullable();
//        $table->timestamp('published_at')->nullable();
//        $table->boolean('is_published')->default(false);
//        $table->text('preview_text')->nullable();
//        $table->text('content')->nullable();
//        $table->timestamps();

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                ToggleColumn::make('is_published')
                    ->label('Опубликовано')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Дата изменения')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->groups([
                Group::make('category.name')
                    ->label('Категория'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
