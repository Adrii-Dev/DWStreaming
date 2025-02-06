<form action = "{{ route('peliculas.destroy', $pelicula->id)}}" method = "POST">
    @method('DELETE')
    @csrf
    <button onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?')">Borrar</button>
</form>
