@extends('layouts.app')

@section('titulo', 'Inicio')
@section('descripcion', 'Elige qué parte de tu inventario quieres administrar.')

@section('contenido')
<div class="inicio-grid">
    <a class="tarjeta acceso" href="{{ route('productos.index') }}">
        <h2>Ver productos</h2>
        <p>Consulta productos, precios y existencias.</p>
        <strong>{{ $totalProductos }} productos</strong>
    </a>

    <a class="tarjeta acceso" href="{{ route('categorias.index') }}">
        <h2>Ver categorías</h2>
        <p>Organiza los productos de tu inventario.</p>
        <strong>{{ $totalCategorias }} categorías</strong>
    </a>
</div>
@endsection