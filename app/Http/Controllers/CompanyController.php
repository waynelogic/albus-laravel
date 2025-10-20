<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function about()
    {
        return Inertia::render('company/About');
    }

    public function contacts()
    {
        return Inertia::render('company/Contacts');
    }
}
