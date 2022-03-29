<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switchLocale(string $locale)
    {
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
