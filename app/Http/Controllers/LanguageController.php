<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    // set the session's locale variable to either 'en' or 'hu'
    // SetLocaleMiddleware will take care of setting the application locale based on the session data
    public function switchLanguage(string $locale): RedirectResponse
    {
        Session::put('locale', $locale === 'en' ? 'en' : 'hu');
        return redirect()->back();
    }
}
