<?php

namespace Waynelogic\Emporium\Database\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Waynelogic\Emporium\Models\Review;

trait HasReviews
{
    public function reviews() : MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
