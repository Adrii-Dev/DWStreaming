<!-- Navegador entre paginas -->
<nav>
    <a class="btn btn-primary" href="{{ route('welcome')}}" role="button">{{__('messages.nav_inicio')}}</a>
    <a class="btn btn-primary" href="{{ route('catalogo')}}" role="button">{{__('messages.nav_catalogo')}}</a>
    <a class="btn btn-primary" href="{{ route('directores')}}" role="button">{{__('messages.nav_director')}}</a>
</nav>
