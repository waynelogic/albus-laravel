<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Waynelogic\Corporate\Models\Partner;
use Waynelogic\Emporium\Models\Product;
use Waynelogic\Emporium\Services\PriceService;
use Waynelogic\FilamentBlog\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'partners' => fn() => Partner::query()->where('is_active', true)->get()->append('logo_url'),
            'posts' => fn() => Post::query()->with('category')->published()->hasCover()->take(3)->get()->append('cover_url'),
            'products' => fn() => Product::query()->with(['category:id,name,slug', 'main_price'])->get()->append('cover_url')
        ]);
    }
}
