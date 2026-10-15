<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') | Mi inventario</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #f7efe5;
            color: #49372e;
            font-family: Arial, sans-serif;
        }
        main { max-width: 1050px; margin: 45px auto; padding: 0 20px; }
        .marca { color: #a34f36; font-weight: bold; letter-spacing: 1px; }
        h1 { color: #603c2d; margin-bottom: 8px; }
        .descripcion { color: #78665b; margin-bottom: 28px; }
        section, .tarjeta {
            background: #fffdf9;
            border: 1px solid #ead9c6;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 0 5px 18px #68452b12;
        }
        .inicio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
        }
        .acceso {
            display: block;
            color: inherit;
            text-decoration: none;
            border-top: 5px solid #d77b45;
            transition: transform .15s;
        }
        .acceso:hover { transform: translateY(-3px); }
        .acceso strong { display: block; color: #a34f36; font-size: 24px; margin-top: 12px; }
        .formulario { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; align-items: end; }
        label { display: block; margin-bottom: 6px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #d8c8b8; border-radius: 7px; }
        button, .boton {
            display: inline-block; padding: 10px 14px; border: 0; border-radius: 7px;
            background: #a34f36; color: white; text-decoration: none; cursor: pointer;
        }
        .secundario { background: #806b5d; }
        .eliminar { background: #a6382f; }
        .volver { display: inline-block; margin: 18px 0; color: #a34f36; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { text-align: left; padding: 11px; border-bottom: 1px solid #eee3d8; }
        .acciones { display: flex; gap: 7px; align-items: center; }
        .mensaje { background: #f3e3cf; padding: 12px; border-radius: 7px; margin-bottom: 18px; }
        .error { color: #a6382f; }
    </style>
</head>
<body>
<main>
    <div class="marca">MI INVENTARIO</div>
    <h1>@yield('titulo')</h1>
    <p class="descripcion">@yield('descripcion')</p>

    @if (!request()->routeIs('inicio'))
        <a class="volver" href="{{ route('inicio') }}">← Volver a Inicio</a>
    @endif

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

    @yield('contenido')
</main>
</body>
</html>