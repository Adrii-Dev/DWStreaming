<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Pagina principal, la de Inicio -->
    <div class="containerInicio">
        <header class="cabecera">
            <h1>{{__('messages.catalogo')}}</h1>
            <p>{{__('messages.titulo')}}</p>
        </header>

        <div class="nav">
            @include('lenguaje')
        </div>
        <!-- Formularios de autenticación -->
        @auth
            <div class="user-info">
                <p>{{__('messages.bienvenido')}}, {{ Auth::user()->name }}</p>
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

                    <br>
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
