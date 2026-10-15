<?php

use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InventarioController::class, 'inicio'])->name('inicio');
Route::get('/productos', [InventarioController::class, 'productos'])->name('productos.index');
Route::get('/categorias', [InventarioController::class, 'categorias'])->name('categorias.index');

Route::post('/productos', [InventarioController::class, 'guardarProducto'])->name('productos.store');
Route::put('/productos/{producto}', [InventarioController::class, 'actualizarProducto'])->name('productos.update');
Route::delete('/productos/{producto}', [InventarioController::class, 'eliminarProducto'])->name('productos.destroy');

Route::post('/categorias', [InventarioController::class, 'guardarCategoria'])->name('categorias.store');
Route::put('/categorias/{categoria}', [InventarioController::class, 'actualizarCategoria'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [InventarioController::class, 'eliminarCategoria'])->name('categorias.destroy');