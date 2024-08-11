<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the application language.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage($locale)
    {
        // Check if the requested locale is available
        if (in_array($locale, config('app.available_locales'))) {
            // Store the selected language in the session
            Session::put('locale', $locale);

            // Set the application locale
            App::setLocale($locale);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
