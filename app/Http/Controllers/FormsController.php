<?php

namespace App\Http\Controllers;

use App\MagicForms\CallbackForm;
use App\MagicForms\ContactForm;
use Illuminate\Http\Request;
use Waynelogic\MagicForms\Http\Controllers\MagicFormsController;

class FormsController extends MagicFormsController
{
    public function getForms(): array
    {
        return [
            'contact' => ContactForm::class,
            'callback' => CallbackForm::class,
        ];
    }


    public function success(Request $request)
    {
        return redirect()->back();
    }
}
