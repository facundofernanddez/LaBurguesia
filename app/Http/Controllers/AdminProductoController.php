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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'activo' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
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
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe tener un formato válido (jpeg, png, jpg, gif, svg, webp).',
            'imagen.max' => 'La imagen no puede pesar más de 2MB.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor a 0.',
        ]);

        $imageName = null;
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        }

        Producto::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $imageName,
            'activo' => $request->boolean('activo'),
            'stock' => $validated['stock'],
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'activo' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
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
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe tener un formato válido (jpeg, png, jpg, gif, svg, webp).',
            'imagen.max' => 'La imagen no puede pesar más de 2MB.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor a 0.',
        ]);

        $imageName = $producto->imagen;
        if ($request->hasFile('imagen')) {
            // Delete old image if it exists
            if ($producto->imagen && file_exists(public_path('img/' . $producto->imagen))) {
                @unlink(public_path('img/' . $producto->imagen));
            }
            $image = $request->file('imagen');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        }

        $producto->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $imageName,
            'activo' => $request->boolean('activo'),
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }
}
