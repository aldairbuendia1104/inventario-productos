@extends('layouts.app')

@section('titulo', $categoria->exists ? 'Editar categoría' : 'Nueva categoría')

@section('contenido')
<div class="panel">
    <h1>{{ $categoria->exists ? 'Editar categoría' : 'Nueva categoría' }}</h1>

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ $categoria->exists ? route('categorias.update', $categoria) : route('categorias.store') }}">
        @csrf
        @if ($categoria->exists)
            @method('PUT')
        @endif

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required maxlength="100">

        <button type="submit">Guardar</button>
        <a class="boton secundario" href="{{ route('categorias.index') }}">Cancelar</a>
    </form>
</div>
@endsection