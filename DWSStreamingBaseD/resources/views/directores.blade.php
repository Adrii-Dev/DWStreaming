<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Directores</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Pagina para ver la lista de actores con sus respectivas peliculas -->
    <div class="containerInicio">
        <header class="cabecera">
            <h1>{{__('messages.titulo_director')}}</h1>
            <p>{{__('messages.directores')}}</p>
        </header>

        <div>
            <!-- La lista de directores -->
                    @foreach($directores as $director)
                        <div class="lista">
                            <strong>{{ $director->nombre}}</strong><br>
                            <p>{{__('messages.apellido')}} {{ $director->apellido }}</p>
                            <p>{{__('messages.dni')}} {{ $director->dni }}</p>
                            <p>{{__('messages.lista')}}</p>
                            @if ($director->peliculas->isEmpty())
                                <p>No tiene películas registradas.</p>
                            @else
                                <div class="inden">
                                @foreach ($director->peliculas as $pelicula)
                                    <strong>{{ $pelicula->nombre}}</strong>
                                    <p>{{__('messages.año')}} {{ $pelicula->año }}</p>
                                    <p>{{__('messages.genero')}} {{ $pelicula->genero }}</p><br>
                                @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
        </div>
        <!-- Paginacion -->
        {{ $directores->links() }}
        <!-- Para navegar entre las paginas -->
        <div class="nav">
            @include('nav')
        </div>

        <footer>
            <p>&copy; {{__('messages.copy')}}</p>
            <p>{{__('messages.contacto')}}</p>
        </footer>
    </div>
</body>
</html>
