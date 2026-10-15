<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Category::orderBy('nombre')->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.formulario', [
            'categoria' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categories,nombre',
        ]);

        Category::create($datos);

        return redirect()->route('categorias.index');
    }

    public function edit(Category $categoria)
    {
        return view('categorias.formulario', compact('categoria'));
    }

    public function update(Request $request, Category $categoria)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categories,nombre,' . $categoria->id,
        ]);

        $categoria->update($datos);

        return redirect()->route('categorias.index');
    }

    public function destroy(Category $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}