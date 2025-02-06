<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalogo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Pagina donde muestra el catalogo de las peliculas -->
    <div class="containerCatalogo">
        <h1>{{__('messages.catalogo')}}</h1>

        <h1>{{__('messages.titulo')}}</h1>
        <div>

        <div class="nav">
            @include('lenguaje')
        </div>
        <!-- La lista de peliculas -->
                @foreach($peliculas as $pelicula)
                    <div class="lista">
                        <strong>{{ $pelicula->nombre}}</strong><br>
                        <p>{{__('messages.año')}} {{ $pelicula->año }}</p>
                        <p>{{__('messages.genero')}} {{ $pelicula->genero }}</p>
                        <p>{{__('messages.isrc')}} {{ $pelicula->isrc->isrc }}</p>
                        <p>{{__('messages.tipo')}} {{ $pelicula->isrc->tipo }}</p>
                        @if ($pelicula->video_url)
                            {!! $pelicula->video !!}
                        @endif
                    </div>
                @endforeach
        </div>
        <!-- Para añadir peliculas a la lista segun si estas logeado o no -->
        @auth
        <div class="log">
            <form action="{{ route('validar') }}" method="GET">
                @csrf
                <button type="submit">{{__('messages.formulario_pelicula')}}</button>
            </form>
            <form action="{{ route('validarElenco') }}" method="GET">
                @csrf
                <button type="submit">{{__('messages.formulario_elenco')}}</button>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">{{__('messages.cerrar_sesion')}}</button>
            </form>
        </div>
        @else
        <!-- Para poder registrarse o logearte -->
        <div class="auth">
            <h3>{{__('messages.titulo_login')}}</h3>
            <div class="nav">
                <h2>{{__('messages.login')}}</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">{{__('messages.login')}}</button>
                </form>
            </div>
            <h3>{{__('messages.titulo_registro')}}</h3>
            <div class="nav">
                <h2>{{__('messages.registro')}}</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">{{__('messages.registro')}}</button>
                </form>
            </div>
        </div>
        @endauth
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
