<?php

namespace Tests\Feature;
use App\Http\Controllers\CalculadoraController;


use Tests\TestCase;

class CalculadoraTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // Test para comprobar que la suma de dos numeros es correcta
    public function test_suma_dos_numeros_correctamente() {
        $calculadora = new CalculadoraController();
        $resultado = $calculadora->suma(3, 3);
        expect($resultado)->toBe(6);
    }
}
