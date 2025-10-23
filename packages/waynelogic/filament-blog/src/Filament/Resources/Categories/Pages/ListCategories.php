<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
