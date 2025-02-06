<?php

namespace App\Http\Controllers;

use App\Models\ISRC;
use App\Models\Pelicula;
use App\Models\Director;
use App\Models\Elenco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
    public function añadir(Request $request){
        //Validamos la entrada de catalogos
        $request->validate([
            'nombre' => 'required',
            'año' => 'required',
            'genero' => 'required',
            'isrc' => 'required',
            'tipo' => 'required',
            'director' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'video_url' => 'nullable|url'
        ]);

        $director = Director::firstOrCreate(
            [
                'dni' => $request->dni
            ],
            [
                'nombre' => $request->director,
                'apellido' => $request->apellido
            ]
        );

        $peliNueva = new Pelicula;
        $peliNueva->nombre = $request->nombre;
        $peliNueva->año = $request->año;
        $peliNueva->genero = $request->genero;
        $peliNueva->director_id = $director->id;
        $peliNueva->video_url = $request->video_url;

        $peliNueva->save();

        $isrcNuevo = new ISRC;
        $isrcNuevo->isrc = $request->isrc;
        $isrcNuevo->peli_id = $peliNueva->id;
        $isrcNuevo->tipo = $request->tipo;

        $isrcNuevo->save();

        $peliNueva->isrc_id = $isrcNuevo->id;
        $peliNueva->save();

        return redirect()->route('catalogo');
    }

    //Funcion para añadir peliculas y redirigir a añadir elenco
    public function añadirYRedirigir(Request $request){
        //Validamos la entrada de catalogos
        $request->validate([
            'nombre' => 'required',
            'año' => 'required',
            'genero' => 'required',
            'isrc' => 'required',
            'tipo' => 'required',
            'director' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'nombreActor' => 'required',
            'apellidoActor' => 'required',
            'dniActor' => 'required',
            'tipoActor' => 'required',
            'video_url' => 'nullable|url'
        ]);

        $director = Director::firstOrCreate(
            [
                'dni' => $request->dni
            ],
            [
                'nombre' => $request->director,
                'apellido' => $request->apellido
            ]
        );
        $elenco = Elenco::firstOrCreate(
            [
                'dni' => $request->dniActor
            ],
            [
                'nombre' => $request->nombreActor,
                'apellido' => $request->apellidoActor,
                'tipo' => $request->tipoActor
            ]
        );

        $peliNueva = new Pelicula;
        $peliNueva->nombre = $request->nombre;
        $peliNueva->año = $request->año;
        $peliNueva->genero = $request->genero;
        $peliNueva->director_id = $director->id;
        $peliNueva->video_url = $request->video_url;

        $peliNueva->save();

        $isrcNuevo = new ISRC;
        $isrcNuevo->isrc = $request->isrc;
        $isrcNuevo->peli_id = $peliNueva->id;
        $isrcNuevo->tipo = $request->tipo;

        $isrcNuevo->save();

        $peliNueva->isrc_id = $isrcNuevo->id;
        $peliNueva->save();

        // Asociar el elenco a la película en la tabla pivote
        $peliNueva->elencos()->attach($elenco->id);

        return redirect()->route('catalogo');
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
