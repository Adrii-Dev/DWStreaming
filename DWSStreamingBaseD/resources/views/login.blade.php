<!-- YA NO UTILIZO ESTE LOGIN DESDE LA IMPLEMENTACION DE AUTH -->
<!-- Login para el susuario -->
<!-- Si no estas logeado se mete por el primer if ya que la variable 'validar' no esta inicializada -->
@if (session('validar') === null)
    <!-- Formulario para validar el login -->
    <p>¿Quieres logearte?</p>
    <form action="{{ route('logearte') }}" method="POST">
        @csrf
        <label for="nombre">Nombre de usuario:</label><br>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Iniciar sesión</button>
    </form>
@else
    <!-- Una vez intenato el login, depende de si te ha mandado false o true -->
    <!-- Si ha devuelto true -->
    @if (session('validar'))
        <p>Bienvenido, {{ session('nombre') }}.</p>
        <p>¿Quieres cerrar sesión?</p>
        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
        </form>
    <!-- Si ha devuelto false -->
    @else
        <p>Nombre de usuario no válido. Por favor, intenta de nuevo.</p>
        <form action="{{ route('logearte') }}" method="POST">
            @csrf
            <label for="nombre">Nombre de usuario:</label><br>
            <input type="text" id="nombre" name="nombre" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    @endif
@endif
