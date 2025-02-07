<?php

namespace App\Http\Controllers;

use App\Models\ISRC;
use App\Models\Pelicula;
use App\Models\Director;
use App\Models\Elenco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PeliculaController extends Controller
{
    //Controlador creado para manejar el catalogo de peliculas
    //Esta funcion te devuelve la tabla de los catalogos conectando con el modelo
    public function catalogo(){
        $peliculas = Pelicula::with('isrc')->get();
        return view('catalogo', compact('peliculas'));
    }
    public function validar() {
        return view('validar');
    }
    public function validarElenco() {
        return view('validarElenco');
    }

    //Funcion para añadir peliculas al catalogo
    public function añadir(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'año' => 'required|integer',
                'genero' => 'required|string|max:100',
                'isrc' => 'required|integer',
                'tipo' => 'required|string|max:255',
                'director' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'dni' => 'required|string|max:20',
                'video_url' => 'nullable|url'
            ]);

            return DB::transaction(function () use ($request) {
                $director = Director::firstOrCreate(
                    [
                        'dni' => $request->dni
                    ],
                    [
                        'nombre' => $request->director,
                        'apellido' => $request->apellido
                    ]
                );

                $peliNueva = Pelicula::create([
                    'nombre' => $request->nombre,
                    'año' => $request->año,
                    'genero' => $request->genero,
                    'director_id' => $director->id,
                    'video_url' => $request->video_url
                ]);

                $isrcNuevo = ISRC::create([
                    'isrc' => $request->isrc,
                    'peli_id' => $peliNueva->id,
                    'tipo' => $request->tipo
                ]);

                $peliNueva->update(['isrc_id' => $isrcNuevo->id]);

                return redirect()->route('catalogo');
            });

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al añadir la película',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //Funcion para añadir peliculas y elenco
    public function añadirYRedirigir(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'año' => 'required|integer',
                'genero' => 'required|string|max:100',
                'isrc' => 'required|integer',
                'tipo' => 'required|string|max:255',
                'director' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'dni' => 'required|string|max:20',
                'video_url' => 'nullable|url',
                'nombreActor' => 'required|string|max:255',
                'apellidoActor' => 'required|string|max:255',
                'dniActor' => 'required|string|max:20',
                'tipoActor' => 'required|string|max:255'
            ]);

            return DB::transaction(function () use ($request) {
                // Crear o encontrar director
                $director = Director::firstOrCreate(
                    ['dni' => $request->dni],
                    [
                        'nombre' => $request->director,
                        'apellido' => $request->apellido
                    ]
                );

                // Crear o encontrar actor
                $elenco = Elenco::firstOrCreate(
                    ['dni' => $request->dniActor],
                    [
                        'nombre' => $request->nombreActor,
                        'apellido' => $request->apellidoActor,
                        'tipo' => $request->tipoActor
                    ]
                );

                // Crear película
                $peliNueva = Pelicula::create([
                    'nombre' => $request->nombre,
                    'año' => $request->año,
                    'genero' => $request->genero,
                    'director_id' => $director->id,
                    'video_url' => $request->video_url
                ]);

                // Crear ISRC
                $isrcNuevo = ISRC::create([
                    'isrc' => $request->isrc,
                    'peli_id' => $peliNueva->id,
                    'tipo' => $request->tipo
                ]);

                // Actualizar película con ISRC
                $peliNueva->update(['isrc_id' => $isrcNuevo->id]);

                // Asociar elenco con la película
                $peliNueva->elencos()->attach($elenco->id);

                return redirect()->route('catalogo')->with('success', 'Película y elenco añadidos correctamente');
            });

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al añadir la película',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //Funcion para mostrar el formulario de añadir elenco
    public function mostrarFormularioElenco($pelicula_id){
        return view('añadirElenco', compact('pelicula_id'));
    }

    //Funcion para añadir elenco a una pelicula
    public function añadirElenco(Request $request, $pelicula_id){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'tipo' => 'required'
        ]);

        $elenco = Elenco::firstOrCreate(
            [
                'dni' => $request->dni
            ],
            [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'tipo' => $request->tipo
            ]
        );

        $pelicula = Pelicula::findOrFail($pelicula_id);
        $pelicula->elencos()->attach($elenco->id);

        return redirect()->route('catalogo');
    }

    //Utilizamos la funcion de borrar que nos da el controlador de recursos
    public function destroy($id)
    {
        //Buscamos la película por su ID
        $pelicula = Pelicula::findOrFail($id);
        $isrc = ISRC::find($pelicula->isrc_id);

        $isrc->delete();
        $pelicula->delete();

        return back();
    }
}
