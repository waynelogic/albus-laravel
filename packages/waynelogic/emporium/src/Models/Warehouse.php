<?php namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Waynelogic\FilamentCms\Database\Traits\Defaultable;
use Waynelogic\FilamentCms\Database\Traits\HasExternalId;
use Waynelogic\FilamentCms\Database\Traits\Sluggable;
use Waynelogic\FilamentCms\Database\Traits\Sortable;

class Warehouse extends Model
{
    use Sortable, Sluggable, Defaultable, HasExternalId;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'phone',
    ];

    protected array $slugs = [
        'slug' => 'name',
    ];

    public function products() : HasManyThrough
    {
        return $this->hasManyThrough(Product::class, Stock::class, 'warehouse_id', 'product_id');
    }
    public function stocks() : HasMany
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
}
