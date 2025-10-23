<?php

namespace Waynelogic\FilamentBlog\Filament\Resources\Posts\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Waynelogic\FilamentBlog\Filament\Resources\Posts\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected Width | string | null $maxContentWidth = Width::Full;
}
