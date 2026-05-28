<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function store(Request $request)
    {
        $categoriaOptions = Categoria::pluck('nombre')->toArray();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|not_in:0',
            'categoria' => ['required', 'string', 'in:'.implode(',', $categoriaOptions)],
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
            'precio.not_in' => 'El precio no puede ser 0.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.string' => 'La categoría debe ser texto.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
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

    public function update(Request $request, Producto $producto)
    {
        $categoriaOptions = Categoria::pluck('nombre')->toArray();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|not_in:0',
            'categoria' => ['required', 'string', 'in:'.implode(',', $categoriaOptions)],
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
            'precio.not_in' => 'El precio no puede ser 0.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.string' => 'La categoría debe ser texto.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
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

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }
}
