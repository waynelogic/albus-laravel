<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Waynelogic\Emporium\Models\Category;

class CatalogController extends Controller
{
    public function index()
    {
        return Inertia::render('catalog/Index', [
            'categories' => fn() => Category::query()->get(),
        ]);
    }
}
