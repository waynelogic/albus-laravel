<?php

namespace Waynelogic\Emporium\Filament\Forms\Components;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ImageUpload extends SpatieMediaLibraryFileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->imageEditor()->acceptedFileTypes(['image/*']);
    }

    public static function make(?string $name = null): static
    {
        return parent::make($name)->collection($name);
    }
}
