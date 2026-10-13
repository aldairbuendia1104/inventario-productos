@extends('layouts.app')

@section('titulo', 'Categorías')

@section('contenido')
<div class="panel">
    <h1>Categorías</h1>
    <p>Organiza tus productos por categoría.</p>
    <a class="boton" href="{{ route('categorias.create') }}">Nueva categoría</a>

    @if ($categorias->isEmpty())
        <p>Aún no hay categorías.</p>
    @else
        <table>
            <thead><tr><th>Nombre</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td class="acciones">
                            <a class="boton secundario" href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                            <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf
                                @method('DELETE')
                                <button class="eliminar" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection