<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/productos');

Route::resource('categorias', CategoryController::class)
    ->except(['show']);

Route::resource('productos', ProductoController::class)
    ->except(['show']);