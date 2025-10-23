<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Tags\Pages;

use Filament\Resources\Pages\CreateRecord;
use Waynelogic\FilamentBlog\Filament\Resources\Tags\TagResource;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
