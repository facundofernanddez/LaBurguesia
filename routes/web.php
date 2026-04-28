<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/frontend/home');
});

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

    $productos = [
        ['id' => 1, 'nombre' => 'Classic Burger', 'categoria' => 'hamburguesas', 'precio' => 1500, 'descripcion' => 'Hamburguesa clásica con lechuga, tomate y nuestra salsa secreta.', 'imagen' => 'clasica.png', 'categoria_nombre' => 'Clásica'],
        ['id' => 2, 'nombre' => 'Cheese Burger', 'categoria' => 'hamburguesas', 'precio' => 1800, 'descripcion' => 'Con queso cheddar fundido y tocino crujiente.', 'imagen' => 'cheddar.png', 'categoria_nombre' => 'Con Queso'],
        ['id' => 3, 'nombre' => 'Bacon Burger', 'categoria' => 'hamburguesas', 'precio' => 2000, 'descripcion' => 'Doble porción de tocino y cebolla crispy.', 'imagen' => 'cebolla.png', 'categoria_nombre' => 'Premium'],
        ['id' => 4, 'nombre' => 'Empanada de Carne', 'categoria' => 'empanadas', 'precio' => 500, 'descripcion' => 'Empanada artesanal con carne molida.', 'imagen' => 'empanada1.png', 'categoria_nombre' => 'Carne'],
        ['id' => 5, 'nombre' => 'Empanada de Queso', 'categoria' => 'empanadas', 'precio' => 450, 'descripcion' => 'Empanada con relleno de queso.', 'imagen' => 'empanada2.png', 'categoria_nombre' => 'Queso'],
        ['id' => 6, 'nombre' => 'Papas Chicas', 'categoria' => 'papas', 'precio' => 800, 'descripcion' => 'Papas fritas medianas.', 'imagen' => 'papas1.png', 'categoria_nombre' => 'Chicas'],
        ['id' => 7, 'nombre' => 'Papas Grandes', 'categoria' => 'papas', 'precio' => 1200, 'descripcion' => 'Papas fritas grandes.', 'imagen' => 'papas2.png', 'categoria_nombre' => 'Grandes'],
        ['id' => 8, 'nombre' => 'Coca-Cola', 'categoria' => 'bebidas', 'precio' => 600, 'descripcion' => 'Bebida fría bien helada.', 'imagen' => 'bebida1.png', 'categoria_nombre' => 'Bebida'],
        ['id' => 9, 'nombre' => 'Daiquirí', 'categoria' => 'bebidas', 'precio' => 400, 'descripcion' => 'Daiquirí de naranja.', 'imagen' => 'bebida2.png', 'categoria_nombre' => 'Bebida'],
        ['id' => 10, 'nombre' => 'Agua Mineral', 'categoria' => 'bebidas', 'precio' => 500, 'descripcion' => 'Agua mineral natural y fresca.', 'imagen' => 'bebida3.png', 'categoria_nombre' => 'Bebida'],
        ['id' => 11, 'nombre' => 'Combo Classic', 'categoria' => 'combos', 'precio' => 2200, 'descripcion' => 'Hamburguesa clásica + papas medianas + bebida.', 'imagen' => 'combo1.png', 'categoria_nombre' => 'Combo'],
        ['id' => 12, 'nombre' => 'Combo Premium', 'categoria' => 'combos', 'precio' => 2800, 'descripcion' => 'Bacon burger + papas grandes + bebida.', 'imagen' => 'combo2.png', 'categoria_nombre' => 'Combo'],
    ];

    if ($categoria !== 'todos') {
        $productos = array_filter($productos, fn ($p) => $p['categoria'] === $categoria);
    }

    return view('/frontend/catalogo', compact('productos', 'categoria'));
});
