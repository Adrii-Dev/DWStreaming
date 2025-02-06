<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // Funcion para manejar la ruta de 'welcome'
    public function welcome() {
        return view('welcome');
    }
    // Funcion para manejar la ruta de login
    public function login() {
        return view('login');
    }
    // Funcion que te valida el login del usuario, actua como la 'base de datos de usuarios' para este ejercicio
    public function logearte(Request $request){
    $nombre = $request->input('nombre');
    $validar = $nombre == "admin" ? true : false;

    // Almacenar el estado de validación en la sesión
    session(['validar' => $validar, 'nombre' => $nombre]);

    return back();
    }
    // Funcion para hacer logout
    public function logout(){
    session()->forget('validar'); // Elimina la variable 'validar' de la sesión
    session()->forget('nombre'); // Elimina la variable 'nombre' de la sesión

    return back(); // Redirige a la vista original
    }

}

