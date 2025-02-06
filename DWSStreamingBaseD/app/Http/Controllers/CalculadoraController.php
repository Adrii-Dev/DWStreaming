<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    // Controlador para las pruebas con Pest
    // Funcion que suma dos numeros y devuelve el resultado para ser testeado
    public function suma($a, $b)
    {
        return $a + $b;
    }
}
