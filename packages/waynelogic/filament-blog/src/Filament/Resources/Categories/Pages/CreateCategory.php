<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Categories\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Waynelogic\FilamentBlog\Filament\Resources\Categories\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
