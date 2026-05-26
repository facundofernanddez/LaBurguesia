<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $usuarios = Usuario::count();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        $editingProducto = $request->filled('edit_producto')
            ? Producto::find($request->edit_producto)
            : null;

        return view('backend.admin.dashboard', compact('usuarios', 'productos', 'editingProducto'));
    }

    public function storeProducto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|min:0',
            'categoria' => 'required|string|in:hamburguesas,empanadas,papas,bebidas,combos',
            'imagen' => 'nullable|string|max:100',
            'activo' => 'nullable|boolean',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede superar los :max caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.integer' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor a 0.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.string' => 'La categoría debe ser texto.',
        ]);

        Producto::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $validated['imagen'] ?? null,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Producto creado correctamente.');
    }

    public function updateProducto(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|min:0',
            'categoria' => 'required|string|in:hamburguesas,empanadas,papas,bebidas,combos',
            'imagen' => 'nullable|string|max:100',
            'activo' => 'nullable|boolean',
        ]);

        $producto->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $validated['imagen'] ?? null,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroyProducto(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }
}
