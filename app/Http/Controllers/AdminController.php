<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $usuarios = Usuario::count();
        $usuariosList = Usuario::with('rol')->orderBy('created_at', 'desc')->get();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        $categorias = Categoria::orderBy('nombre')->get();
        $categoriaOptions = $categorias->pluck('nombre')->toArray();

        $editingProducto = $request->filled('edit_producto')
            ? Producto::find($request->edit_producto)
            : null;

        $editingCategoria = $request->filled('edit_categoria')
            ? Categoria::find($request->edit_categoria)
            : null;

        return view('backend.admin.dashboard', compact(
            'usuarios',
            'usuariosList',
            'productos',
            'categorias',
            'categoriaOptions',
            'editingProducto',
            'editingCategoria'
        ));
    }

    public function storeProducto(Request $request)
    {
        $categoriaOptions = Categoria::pluck('nombre')->toArray();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|min:0',
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
            'precio.min' => 'El precio debe ser mayor a 0.',
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

    public function updateProducto(Request $request, Producto $producto)
    {
        $categoriaOptions = Categoria::pluck('nombre')->toArray();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|integer|min:0',
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
            'precio.min' => 'El precio debe ser mayor a 0.',
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

    public function destroyProducto(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }

    public function updateUsuarioRol(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'rol' => 'required|string|in:admin,cliente',
        ], [
            'rol.required' => 'El rol es obligatorio.',
            'rol.string' => 'El rol debe ser texto.',
            'rol.in' => 'El rol seleccionado no es válido.',
        ]);

        $rol = Rol::where('nombre', $validated['rol'])->first();

        if (! $rol) {
            return redirect()->route('admin.dashboard')->with('success', 'El rol seleccionado no es válido.');
        }

        $usuario->update(['rol_id' => $rol->id]);

        return redirect()->route('admin.dashboard')->with('success', 'Rol de usuario actualizado correctamente.');
    }

    public function updateUsuarioActivo(Request $request, Usuario $usuario)
    {
        $activo = $request->boolean('activo');

        $usuario->update(['activo' => $activo]);

        return redirect()->route('admin.dashboard')->with('success', 'Estado de usuario actualizado correctamente.');
    }

    public function storeCategoria(Request $request)
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

    public function updateCategoria(Request $request, Categoria $categoria)
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

    public function destroyCategoria(Categoria $categoria)
    {
        if (Producto::where('categoria', $categoria->nombre)->exists()) {
            return redirect()->route('admin.dashboard')->with('success', 'No se puede eliminar la categoría porque hay productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Categoría eliminada correctamente.');
    }
}
