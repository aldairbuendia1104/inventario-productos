@extends('layouts.app')

@section('titulo', 'Categorías')
@section('descripcion', 'Crea y organiza las categorías de tus productos.')

@section('contenido')
<section>
    <h2>{{ $categoriaEditar->exists ? 'Editar categoría' : 'Crear categoría' }}</h2>
    <form class="formulario" method="POST"
          action="{{ $categoriaEditar->exists ? route('categorias.update', $categoriaEditar) : route('categorias.store') }}">
        @csrf
        @if ($categoriaEditar->exists) @method('PUT') @endif

        <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $categoriaEditar->nombre) }}" required>
        </div>
        <div>
            <button>{{ $categoriaEditar->exists ? 'Guardar cambios' : 'Crear categoría' }}</button>
            @if ($categoriaEditar->exists)
                <a class="boton secundario" href="{{ route('categorias.index') }}">Cancelar</a>
            @endif
        </div>
    </form>
</section>

<section>
    <h2>Todas las categorías</h2>
    <table>
        <thead><tr><th>Nombre</th><th>Acciones</th></tr></thead>
        <tbody>
        @forelse ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td class="acciones">
                    <a class="boton secundario" href="{{ route('categorias.index', ['editar' => $categoria->id]) }}">Editar</a>
                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Eliminar esta categoría?')">
                        @csrf
                        @method('DELETE')
                        <button class="eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="2">Todavía no hay categorías.</td></tr>
        @endforelse
        </tbody>
    </table>
</section>
@endsection