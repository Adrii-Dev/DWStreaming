<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($lang)
    {
        // Lista de idiomas permitidos
        $availableLanguages = ['es', 'en'];

        if (in_array($lang, $availableLanguages)) {
            // Guardamos el idioma en la sesión
            session(['app_locale' => $lang]);
        }

        // Redireccionamos a la página anterior
        return redirect()->back();
    }
}
