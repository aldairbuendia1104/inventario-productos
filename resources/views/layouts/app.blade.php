<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Mi inventario')</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; color: #202938; }
        header { background: #173b57; color: white; padding: 20px max(24px, calc((100% - 1000px) / 2)); }
        header a { color: white; text-decoration: none; font-weight: bold; }
        main { max-width: 1000px; margin: 36px auto; padding: 0 20px; }
        .panel { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 16px #172b3a12; }
        h1 { margin-top: 0; }
        a.boton, button { display: inline-block; background: #167d8d; color: white; border: 0; border-radius: 7px; padding: 10px 15px; text-decoration: none; cursor: pointer; }
        a.secundario { background: #667085; }
        button.eliminar { background: #b42318; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #e5e7eb; }
        input { display: block; width: 100%; padding: 11px; margin: 8px 0 16px; border: 1px solid #cbd5e1; border-radius: 7px; }
        .error { color: #b42318; }
        .acciones { display: flex; gap: 8px; align-items: center; }
    </style>
</head>
<body>
    <header><a href="{{ route('categorias.index') }}">Inventario de productos</a></header>
    <main>@yield('contenido')</main>
</body>
</html>