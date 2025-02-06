<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;
use App\Models\Pelicula;

//Rutas
Route::get('/', [FrontEndController::class, 'welcome'])->name('welcome');
Route::get('catalogo', [PeliculaController::class, 'catalogo'])->name('catalogo');
Route::get('validar', [PeliculaController::class, 'validar'])->name('validar');
Route::get('validarElenco', [PeliculaController::class, 'validarElenco'])->name('validarElenco');
Route::get('directores', [DirectorController::class, 'directores'])->name('directores');
//Route::post('logearte', [FrontEndController::class, 'logearte'])->name('logearte');
// Antiguas rutas del logeo con sesion y sin registro
//Route::post('logout', [FrontEndController::class, 'logout'])->name('logout');
//Route::post('login', [FrontEndController::class, 'login'])->name('login');
Route::post('añadir', [PeliculaController::class, 'añadir'])->name('añadir')->middleware('auth');
Route::post('añadirYRedirigir', [PeliculaController::class, 'añadirYRedirigir'])->name('añadirYRedirigir')->middleware('auth');
Route::get('añadirElenco/{pelicula_id}', [PeliculaController::class, 'mostrarFormularioElenco'])->name('añadirElenco')->middleware('auth');
//Route::post('añadirElenco/{pelicula_id}', [PeliculaController::class, 'añadirElenco'])->name('guardarElenco');
Route::delete('borrar/{id}', [PeliculaController::class, 'destroy'])->name('peliculas.destroy');
// Nuevas rutas para la autenticacion
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// Lenguaje
Route::get('/lang/{lang}', function ($lang, Request $request) {
    $availableLanguages = ['es', 'en'];

    if (in_array($lang, $availableLanguages)) {
        $request->session()->put('app_locale', $lang);
    }

    return redirect()->back();
})->name('lang.switch');
