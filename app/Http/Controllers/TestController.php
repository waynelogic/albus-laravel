<?php

namespace App\Http\Controllers;

use Filament\Facades\Filament;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $panels = empty(Filament::getPanels());
        dd($panels);
    }
}
