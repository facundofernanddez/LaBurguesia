<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre debe tener como máximo 100 caracteres.',
            'nombre.unique' => 'El nombre ya existe.',
            'descripcion.max' => 'La descripción debe tener como máximo 500 caracteres.',
        ]);

        Categoria::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Categoría creada correctamente.');
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,'.$categoria->id,
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre debe tener como máximo 100 caracteres.',
            'nombre.unique' => 'El nombre ya existe.',
            'descripcion.max' => 'La descripción debe tener como máximo 500 caracteres.',
        ]);

        $oldName = $categoria->nombre;

        $categoria->update($validated);

        if ($oldName !== $validated['nombre']) {
            Producto::where('categoria', $oldName)->update(['categoria' => $validated['nombre']]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if (Producto::where('categoria', $categoria->nombre)->exists()) {
            return redirect()->route('admin.dashboard')->with('success', 'No se puede eliminar la categoría porque hay productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Categoría eliminada correctamente.');
    }
}
