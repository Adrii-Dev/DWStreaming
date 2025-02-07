<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Formulario para agregar peliculas con elenco-->
    <div class="containerCatalogo">
        <p>{{__('messages.titulo_validar')}}</p>
        <form action="{{ route('añadirYRedirigir') }}" method="POST">
            @csrf
            <label for="nombre">{{__('messages.nombre_pelicula')}}</label><!-- Nombre de la pelicula -->
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="año">{{__('messages.año')}}</label><!-- Año de la pelicula -->
            <input type="text" id="año" name="año" required><br>
            <label for="genero">{{__('messages.genero')}}</label><!-- Genero de la pelicula -->
            <input type="text" id="genero" name="genero" required><br>
            <label for="isrc">{{__('messages.isrc')}}</label><!-- ISRC -->
            <input type="text" id="isrc" name="isrc" placeholder="Numero 6 cifras" required><br>
            <label for="tipo">{{__('messages.tipo')}}</label><!-- Tipo de la pelicula -->
            <input type="text" id="tipo" name="tipo" required><br>
            <label for="director">{{__('messages.nombre_director')}}</label><!-- Nombre del director -->
            <input type="text" id="director" name="director" required><br>
            <label for="apellido">{{__('messages.apellido')}}</label><!-- Apellido del director -->
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="dni">{{__('messages.dni')}}</label><!-- DNI Director -->
            <input type="text" id="dni" name="dni" placeholder="Numero 4 cifras" required><br>
            <label for="dni">{{__('messages.nombre_actor')}}</label><!-- Nombre del actor-->
            <input type="text" id="nombreActor" name="nombreActor" required><br>
            <label for="dni">{{__('messages.apellido')}}</label><!-- Apellido del actor-->
            <input type="text" id="apellidoActor" name="apellidoActor" required><br>
            <label for="dni">{{__('messages.dni')}}</label><!-- DNI del actor-->
            <input type="text" id="dniActor" name="dniActor" placeholder="Numero 4 cifras" required><br>
            <label for="dni">{{__('messages.tipo_actor')}}</label><!-- Tipo del actor-->
            <input type="text" id="tipoActor" name="tipoActor" required><br>
            <label for="video_url">{{__('messages.url')}}</label><!-- URL de la pelicula -->
            <input type="url" id="video_url" name="video_url" placeholder="https://www.youtube.com/watch?v=..."><br>
            <button type="submit">{{__('messages.boton_elenco')}}</button><!-- Boton pelicula y elenco-->
        </form>
    </div>
</body>
</html>
