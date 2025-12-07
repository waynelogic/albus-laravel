<?php

namespace App\Http\Controllers;

use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Waynelogic\Emporium\Models\Offer;

class TestController extends Controller
{
    public function index() {
        $obOffer = Offer::query()->find(2);
        $obOffer->main_price()->update([
            'price' => 150,
            'old_price' => 200,
        ]);
//        $panels = empty(Filament::getPanels());
//        dd($panels);
    }
}
