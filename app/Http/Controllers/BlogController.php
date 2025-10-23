<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Waynelogic\FilamentBlog\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        return Inertia::render('blog/Index');
    }

    public function post($post)
    {
        return Inertia::render('blog/Post', [
            'post' => fn() => Post::query()->where('slug', $post)->firstOrFail()->append('cover_url')
        ]);
    }
}
