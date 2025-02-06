<!-- filepath: /home/adriibanez/works/DWSStreamingBaseD/resources/views/añadirElenco.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Elenco</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Vista para añadir una pelicula y su elenco -->
    <div class="container">
        <h1>Añadir Elenco a la Película</h1>
        <form action="{{ route('guardarElenco', ['pelicula_id' => $pelicula_id]) }}" method="POST">
            @csrf
            <label for="nombre">Nombre del Elenco:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellido del Elenco:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="dni">DNI del Elenco:</label>
            <input type="text" id="dni" name="dni" required><br>
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required><br>
            <button type="submit">Añadir Elenco</button>
        </form>
    </div>
</body>
</html>
