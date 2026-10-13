<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de productos</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f3f6f8; color: #243342; font-family: Arial, sans-serif; }
        header { background: #173b57; color: white; padding: 24px; }
        header h1, header p { max-width: 1100px; margin: 0 auto; }
        header p { margin-top: 8px; color: #d8e5ee; }
        main { max-width: 1100px; margin: 28px auto; padding: 0 18px; }
        section { background: white; padding: 22px; margin-bottom: 22px; border-radius: 12px; box-shadow: 0 4px 16px #172b3a12; }
        h2 { margin-top: 0; }
        .formulario { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; align-items: end; }
        label { display: block; font-size: 14px; margin-bottom: 6px; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 7px; }
        button, .boton { padding: 10px 14px; border: 0; border-radius: 7px; background: #167d8d; color: white; cursor: pointer; text-decoration: none; display: inline-block; }
        .gris { background: #667085; }
        .rojo { background: #b42318; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { padding: 11px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .acciones { display: flex; gap: 7px; align-items: center; }
        .mensaje { background: #e6f4ea; padding: 12px; border-radius: 7px; margin-bottom: 18px; }
        .error { color: #b42318; }
        @media (max-width: 650px) { table { font-size: 13px; } th, td { padding: 7px; } }
    </style>
</head>
<body>
<header>
    <h1>Inventario de productos</h1>
    <p>Administra categorías, productos, precios y existencias.</p>
</header>

<main>
    @if (session('mensaje'))
        <div class="mensaje">{{ session('mensaje') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section>
        <h2>{{ $categoriaEditar->exists ? 'Editar categoría' : 'Crear categoría' }}</h2>
        <form class="formulario" method="POST"
              action="{{ $categoriaEditar->exists ? '/categorias/' . $categoriaEditar->id : '/categorias' }}">
            @csrf
            @if ($categoriaEditar->exists)
                @method('PUT')
            @endif

            <div>
                <label for="categoria_nombre">Nombre de la categoría</label>
                <input id="categoria_nombre" name="nombre"
                       value="{{ old('nombre', $categoriaEditar->nombre) }}"
                       placeholder="Ej. Papelería" required maxlength="100">
            </div>

            <div>
                <button type="submit">{{ $categoriaEditar->exists ? 'Guardar cambios' : 'Crear categoría' }}</button>
                @if ($categoriaEditar->exists)
                    <a class="boton gris" href="/">Cancelar</a>
                @endif
            </div>
        </form>

        <h2 style="margin-top:28px">Categorías</h2>
        <table>
            <thead><tr><th>Nombre</th><th>Acciones</th></tr></thead>
            <tbody>
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td class="acciones">
                        <a class="boton gris" href="/?editar_categoria={{ $categoria->id }}">Editar</a>
                        <form method="POST" action="/categorias/{{ $categoria->id }}" onsubmit="return confirm('¿Eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button class="rojo" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2">Todavía no hay categorías.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>

    <section>
        <h2>{{ $productoEditar->exists ? 'Editar producto' : 'Crear producto' }}</h2>
        <form class="formulario" method="POST"
              action="{{ $productoEditar->exists ? '/productos/' . $productoEditar->id : '/productos' }}">
            @csrf
            @if ($productoEditar->exists)
                @method('PUT')
            @endif

            <div>
                <label for="producto_nombre">Nombre</label>
                <input id="producto_nombre" name="nombre"
                       value="{{ old('nombre', $productoEditar->nombre) }}"
                       placeholder="Ej. Cuaderno" required maxlength="150">
            </div>

            <div>
                <label for="category_id">Categoría</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Elige una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            @selected(old('category_id', $productoEditar->category_id) == $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input id="precio" name="precio" type="number" min="0" step="0.01"
                       value="{{ old('precio', $productoEditar->precio) }}" required>
            </div>

            <div>
                <label for="stock">Existencias</label>
                <input id="stock" name="stock" type="number" min="0"
                       value="{{ old('stock', $productoEditar->stock ?? 0) }}" required>
            </div>

            <div>
                <label for="descripcion">Descripción</label>
                <input id="descripcion" name="descripcion"
                       value="{{ old('descripcion', $productoEditar->descripcion) }}"
                       placeholder="Opcional">
            </div>

            <div>
                <button type="submit">{{ $productoEditar->exists ? 'Guardar cambios' : 'Crear producto' }}</button>
                @if ($productoEditar->exists)
                    <a class="boton gris" href="/">Cancelar</a>
                @endif
            </div>
        </form>

        <h2 style="margin-top:28px">Productos</h2>
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
                        <a class="boton gris" href="/?editar_producto={{ $producto->id }}">Editar</a>
                        <form method="POST" action="/productos/{{ $producto->id }}" onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button class="rojo" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Todavía no hay productos.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
</main>
</body>
</html>