@extends('layouts.app')

@section('titulo', 'Productos')
@section('descripcion', 'Registra productos y consulta precios y existencias.')

@section('contenido')
<section>
    <h2>{{ $productoEditar->exists ? 'Editar producto' : 'Crear producto' }}</h2>
    <form class="formulario" method="POST"
          action="{{ $productoEditar->exists ? route('productos.update', $productoEditar) : route('productos.store') }}">
        @csrf
        @if ($productoEditar->exists) @method('PUT') @endif

        <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $productoEditar->nombre) }}" required>
        </div>
        <div>
            <label for="category_id">Categoría</label>
            <select id="category_id" name="category_id" required>
                <option value="">Elige una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(old('category_id', $productoEditar->category_id) == $categoria->id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="precio">Precio</label>
            <input id="precio" name="precio" type="number" min="0" step="0.01" value="{{ old('precio', $productoEditar->precio) }}" required>
        </div>
        <div>
            <label for="stock">Existencias</label>
            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $productoEditar->stock ?? 0) }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <input id="descripcion" name="descripcion" value="{{ old('descripcion', $productoEditar->descripcion) }}">
        </div>
        <div>
            <button>{{ $productoEditar->exists ? 'Guardar cambios' : 'Crear producto' }}</button>
            @if ($productoEditar->exists)
                <a class="boton secundario" href="{{ route('productos.index') }}">Cancelar</a>
            @endif
        </div>
    </form>
</section>

<section>
    <h2>Todos los productos</h2>
    <table>
        <thead><tr><th>Producto</th><th>Categoría</th><th>Precio</th><th>Existencias</th><th>Acciones</th></tr></thead>
        <tbody>
        @forelse ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->category->nombre }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
                <td class="acciones">
                    <a class="boton secundario" href="{{ route('productos.index', ['editar' => $producto->id]) }}">Editar</a>
                    <form method="POST" action="{{ route('productos.destroy', $producto) }}" onsubmit="return confirm('¿Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button class="eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Todavía no hay productos.</td></tr>
        @endforelse
        </tbody>
    </table>
</section>
@endsection