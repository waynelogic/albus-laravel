<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class OrderStatus extends FileModel
{
    use Sortable, Defaultable, Sluggable;

    protected array $slugs = [
        'code' => 'name',
    ];

    protected $fillable = [
        'name',
        'code',
        'color',
        'icon',
        'description',
        'is_cancel',
        'is_complete',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}
