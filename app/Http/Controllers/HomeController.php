<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Waynelogic\Corporate\Models\Partner;
use Waynelogic\FilamentBlog\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'partners' => fn() => Partner::query()->where('is_active', true)->get()->append('logo_url'),
            'posts' => fn() => Post::query()->with('category')->where('has_cover', true)->take(3)->get()->append('cover_url')
        ]);
    }
}
