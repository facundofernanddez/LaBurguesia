<?php

use App\Http\Controllers\AdminCategoriaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

Route::get('/quienessomos', function () {
    return view('/frontend/quienessomos');
});

Route::get('/terminosusos', function () {
    return view('/frontend/terminosusos');
});

Route::get('/contacto', function () {
    return view('/frontend/contacto');
});

Route::post('/contacto', [ContactoController::class, 'contacto']);

Route::get('/comercializacion', function () {
    return view('/frontend/comercializacion');
});

Route::get('/catalogo', function () {
    $categoria = request('categoria', 'todos');

    $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();
    $activeCategoryNames = $categorias->pluck('nombre')->toArray();

    $query = Producto::where('activo', true)->whereIn('categoria', $activeCategoryNames);
    if ($categoria !== 'todos') {
        $query->where('categoria', $categoria);
    }
    $productos = $query->get();

    return view('/frontend/catalogo', compact('productos', 'categorias', 'categoria'));
});

Route::middleware('auth.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar'])->name('login.store');
    Route::get('/register', [AuthController::class, 'formularioRegistro'])->name('register');
    Route::post('/register', [AuthController::class, 'registrar'])->name('register.store');
});

Route::get('/', function () {
    $activeCategoryNames = Categoria::where('activo', true)->pluck('nombre')->toArray();

    $destacados = Producto::where('activo', true)
        ->where('destacado', true)
        ->whereIn('categoria', $activeCategoryNames)
        ->get();

    $carruselProductos = Producto::where('activo', true)
        ->whereNotNull('imagen')
        ->where('imagen', '!=', '')
        ->whereIn('categoria', $activeCategoryNames)
        ->inRandomOrder()
        ->take(5)
        ->get();

    return view('/frontend/home', compact('destacados', 'carruselProductos'));
})->name('Inicio');

Route::middleware('auth')->group(function () {
    Route::post('/carrito/comprar', [App\Http\Controllers\ClienteController::class, 'comprar'])->name('carrito.comprar');
    Route::get('/perfil', [App\Http\Controllers\ClienteController::class, 'perfil'])->name('perfil');
    Route::put('/perfil', [App\Http\Controllers\ClienteController::class, 'updatePerfil'])->name('perfil.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::patch('/admin/productos/{producto}/destacado', [AdminProductoController::class, 'updateDestacado'])->name('admin.productos.updateDestacado');

    Route::resource('admin/productos', AdminProductoController::class)
        ->only(['store', 'update', 'destroy'])
        ->names('admin.productos');

    Route::put('/admin/usuarios/{usuario}/activo', [AdminController::class, 'updateUsuarioActivo'])->name('admin.usuarios.updateActivo');

    Route::post('/admin/consultas/{contacto}/responder', [AdminController::class, 'responderConsulta'])->name('admin.consultas.responder');

    Route::resource('admin/categorias', AdminCategoriaController::class)
        ->only(['store', 'update', 'destroy'])
        ->names('admin.categorias');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
