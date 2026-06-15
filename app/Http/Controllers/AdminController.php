<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\Producto;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RespuestaConsulta;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $usuarios = Usuario::count();
        $usuariosList = Usuario::with('rol')
            ->leftJoin('roles', 'usuarios.rol_id', '=', 'roles.id')
            ->select('usuarios.*')
            ->orderByRaw("CASE WHEN roles.nombre = 'admin' THEN 0 ELSE 1 END")
            ->orderBy('usuarios.created_at', 'desc')
            ->get();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        $categorias = Categoria::orderBy('nombre')->get();
        $categoriaOptions = $categorias->pluck('nombre')->toArray();
        $contactos = Contacto::orderBy('created_at', 'desc')->get();

        // Consulta de ventas con relaciones (todas las ventas se cargan para filtrado dinámico)
        $ventas = Venta::with(['usuario', 'detalles.producto'])
            ->orderBy('created_at', 'desc')
            ->get();

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
            'editingCategoria',
            'contactos',
            'ventas'
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
            'stock' => 'required|integer|min:0',
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
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor a 0.',
        ]);

        Producto::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $validated['imagen'] ?? null,
            'activo' => $request->boolean('activo'),
            'stock' => $validated['stock'],
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
            'stock' => 'required|integer|min:0',
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
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor a 0.',
        ]);

        $producto->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'precio' => $validated['precio'],
            'categoria' => $validated['categoria'],
            'imagen' => $validated['imagen'] ?? null,
            'activo' => $request->boolean('activo'),
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroyProducto(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }

    public function updateUsuarioActivo(Request $request, Usuario $usuario)
    {
        $activo = $request->boolean('activo');

        if (auth()->id() === $usuario->id && ! $activo) {
            return redirect()->route('admin.dashboard')->with('error', 'No puedes desactivar tu propio usuario administrador.');
        }

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

    public function responderConsulta(Request $request, Contacto $contacto)
    {
        $validated = $request->validate([
            'respuesta' => 'required|string|min:5|max:2000',
        ], [
            'respuesta.required' => 'La respuesta es obligatoria.',
            'respuesta.min' => 'La respuesta debe tener al menos 5 caracteres.',
            'respuesta.max' => 'La respuesta no puede superar los 2000 caracteres.',
        ]);

        try {
            Mail::to($contacto->email)->send(new RespuestaConsulta($contacto, $validated['respuesta']));

            $contacto->update([
                'respondido' => true,
                'respuesta' => $validated['respuesta']
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Respuesta enviada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'No se pudo enviar el correo de respuesta: ' . $e->getMessage());
        }
    }
}
