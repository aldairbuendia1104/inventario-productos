<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function inicio()
    {
        return view('inicio', [
            'totalProductos' => Producto::count(),
            'totalCategorias' => Category::count(),
        ]);
    }

    public function productos(Request $request)
    {
        $productos = Producto::with('category')->orderBy('nombre')->get();
        $categorias = Category::orderBy('nombre')->get();
        $productoEditar = $request->filled('editar')
            ? Producto::findOrFail($request->editar)
            : new Producto();

        return view('productos', compact('productos', 'categorias', 'productoEditar'));
    }

    public function categorias(Request $request)
    {
        $categorias = Category::orderBy('nombre')->get();
        $categoriaEditar = $request->filled('editar')
            ? Category::findOrFail($request->editar)
            : new Category();

        return view('categorias', compact('categorias', 'categoriaEditar'));
    }

    public function guardarCategoria(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categories,nombre',
        ]);

        Category::create($datos);

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría guardada.');
    }

    public function actualizarCategoria(Request $request, Category $categoria)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categories,nombre,' . $categoria->id,
        ]);

        $categoria->update($datos);

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría actualizada.');
    }

    public function eliminarCategoria(Category $categoria)
    {
        if ($categoria->productos()->exists()) {
            return back()->with('mensaje', 'No se puede borrar una categoría que tiene productos.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría eliminada.');
    }

    public function guardarProducto(Request $request)
    {
        $datos = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Producto::create($datos);

        return redirect()->route('productos.index')->with('mensaje', 'Producto guardado.');
    }

    public function actualizarProducto(Request $request, Producto $producto)
    {
        $datos = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($datos);

        return redirect()->route('productos.index')->with('mensaje', 'Producto actualizado.');
    }

    public function eliminarProducto(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('mensaje', 'Producto eliminado.');
    }
}