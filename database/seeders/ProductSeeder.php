<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurar que existan todas las categorías
        $categorias = [
            [
                'nombre' => 'Hamburguesas',
                'descripcion' => 'Hamburguesas gourmet elaboradas con carne vacuna de primera y aderezos artesanales.',
                'activo' => true
            ],
            [
                'nombre' => 'Combos',
                'descripcion' => 'Los mejores combos que incluyen hamburguesa, papas fritas y bebida para una comida completa.',
                'activo' => true
            ],
            [
                'nombre' => 'Papas Fritas',
                'descripcion' => 'Papas fritas crujientes en porciones ideales para acompañar o compartir.',
                'activo' => true
            ],
            [
                'nombre' => 'Empanadas',
                'descripcion' => 'Empanadas artesanales fritas o al horno con rellenos súper sabrosos.',
                'activo' => true
            ],
            [
                'nombre' => 'Bebidas',
                'descripcion' => 'Bebidas frescas y gaseosas para acompañar tu menú.',
                'activo' => true
            ],
        ];

        foreach ($categorias as $cat) {
            Categoria::updateOrCreate(
                ['nombre' => $cat['nombre']],
                [
                    'descripcion' => $cat['descripcion'],
                    'activo' => $cat['activo']
                ]
            );
        }

        $productos = [
            // Hamburguesas
            [
                'nombre' => 'Bacon Burger Simple',
                'descripcion' => 'Hamburguesa premium con medallón de carne vacuna, queso cheddar fundido, panceta crocante y salsa barbacoa.',
                'precio' => 6500,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BaconBurguer1.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 50,
            ],
            [
                'nombre' => 'Bacon Burger Doble',
                'descripcion' => 'Hamburguesa premium con doble medallón de carne vacuna, doble queso cheddar fundido, doble panceta y salsa barbacoa.',
                'precio' => 7200,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BaconBurguer2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 45,
            ],
            [
                'nombre' => 'Hamburguesa Americana Simple',
                'descripcion' => 'Clásica hamburguesa de estilo americano con medallón de carne vacuna, queso cheddar, cebolla picada, pepinillos y salsa kétchup y mostaza.',
                'precio' => 6000,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BurguerAmerican1.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 50,
            ],
            [
                'nombre' => 'Hamburguesa Americana Doble',
                'descripcion' => 'Clásica hamburguesa con doble medallón de carne vacuna, doble queso cheddar, cebolla picada, pepinillos, kétchup y mostaza.',
                'precio' => 6800,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BurguerAmerican2.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 40,
            ],
            [
                'nombre' => 'Hamburguesa con Cebolla Simple',
                'descripcion' => 'Exquisita hamburguesa con medallón de carne vacuna, queso cheddar y aros de cebolla artesanal.',
                'precio' => 6200,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BurguerCebolla1.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 50,
            ],
            [
                'nombre' => 'Hamburguesa con Cebolla Doble',
                'descripcion' => 'Exquisita hamburguesa con doble medallón de carne vacuna, doble queso cheddar y aros de cebolla artesanal.',
                'precio' => 6900,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BurguerCebolla2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 45,
            ],
            [
                'nombre' => 'Hamburguesa Cebolla Crispy',
                'descripcion' => 'Hamburguesa gourmet con medallón de carne vacuna, queso cheddar, cebolla caramelizada crispy.',
                'precio' => 7300,
                'categoria' => 'Hamburguesas',
                'imagen' => 'BurguerCebollaCrispy.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 35,
            ],
            [
                'nombre' => 'Hamburguesa Clásica Simple',
                'descripcion' => 'La tradicional hamburguesa con un medallón de carne vacuna, queso danbo, lechuga fresca, rodajas de tomate y aderezo especial.',
                'precio' => 5500,
                'categoria' => 'Hamburguesas',
                'imagen' => 'Burguerclasica1.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 60,
            ],
            [
                'nombre' => 'Hamburguesa Clásica Doble',
                'descripcion' => 'La tradicional hamburguesa con doble medallón de carne vacuna, doble queso danbo, lechuga fresca, rodajas de tomate y aderezo de la casa.',
                'precio' => 6300,
                'categoria' => 'Hamburguesas',
                'imagen' => 'burguerClasica2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 50,
            ],
            [
                'nombre' => 'Hamburguesa Caprese',
                'descripcion' => 'Fresca y gourmet con medallón de carne vacuna, queso mozzarella fundido, tomates confitados, albahaca fresca y un suave pesto.',
                'precio' => 6400,
                'categoria' => 'Hamburguesas',
                'imagen' => 'CapresseBurger.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 30,
            ],
            [
                'nombre' => 'Smoky Burger Simple',
                'descripcion' => 'Hamburguesa ahumada con medallón de carne vacuna, cheddar fundido, cebolla caramelizada y salsa barbacoa ahumada.',
                'precio' => 6700,
                'categoria' => 'Hamburguesas',
                'imagen' => 'SmokyBurger1.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 40,
            ],
            [
                'nombre' => 'Smoky Burger Doble',
                'descripcion' => 'Hamburguesa ahumada con doble medallón de carne vacuna, doble queso cheddar fundido, cebolla caramelizada y salsa barbacoa ahumada.',
                'precio' => 7500,
                'categoria' => 'Hamburguesas',
                'imagen' => 'SmokyBurger2.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 30,
            ],
            [
                'nombre' => 'Hamburguesa La Burguesía Premium',
                'descripcion' => 'Nuestra especialidad con medallón premium de asado, queso cheddar fundido, panceta ahumada, huevo frito, lechuga y tomate.',
                'precio' => 6800,
                'categoria' => 'Hamburguesas',
                'imagen' => 'hambur1.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 40,
            ],
            [
                'nombre' => 'Mega Hamburguesa Triple Cheddar',
                'descripcion' => 'Excesivamente deliciosa con triple medallón de carne, triple queso cheddar, panceta crocante y aderezo especial.',
                'precio' => 7400,
                'categoria' => 'Hamburguesas',
                'imagen' => 'hambur2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 35,
            ],
            [
                'nombre' => 'Hamburguesa Bourbon Special',
                'descripcion' => 'Hamburguesa gourmet con medallón de carne vacuna seleccionada, queso provolone, panceta caramelizada y reducción de whiskey Bourbon.',
                'precio' => 8200,
                'categoria' => 'Hamburguesas',
                'imagen' => 'hambur3.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 25,
            ],

            // Combos
            [
                'nombre' => 'Combo Veggie Burger',
                'descripcion' => 'Medallón de lentejas y arroz integral con palta, lechuga, tomate y alioli. Acompañado de papas fritas y una gaseosa de 500ml.',
                'precio' => 7800,
                'categoria' => 'Combos',
                'imagen' => 'VeggieBurgerCombo.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 30,
            ],
            [
                'nombre' => 'Combo Clásico La Burguesía',
                'descripcion' => 'Hamburguesa clásica simple con queso danbo, lechuga y tomate. Acompañada de una porción de papas fritas y gaseosa de 500ml.',
                'precio' => 8500,
                'categoria' => 'Combos',
                'imagen' => 'combo1.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 50,
            ],
            [
                'nombre' => 'Super Combo Doble Cheddar',
                'descripcion' => 'Hamburguesa doble con abundante queso cheddar y panceta. Acompañada de una porción de papas fritas grandes y trago de la casa.',
                'precio' => 9500,
                'categoria' => 'Combos',
                'imagen' => 'combo2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 40,
            ],

            // Papas Fritas
            [
                'nombre' => 'Papas Fritas Cheddar y Bacon',
                'descripcion' => 'Gran porción de papas fritas bastón crujientes, bañadas en queso cheddar fundido y espolvoreadas con panceta crocante picada.',
                'precio' => 3500,
                'categoria' => 'Papas Fritas',
                'imagen' => 'papasCheddar.png',
                'activo' => true,
                'destacado' => true,
                'stock' => 60,
            ],
            [
                'nombre' => 'Papas Fritas Finas',
                'descripcion' => 'Porción clásica de papas fritas corte fino súper crocantes, sazonadas con un toque de sal marina.',
                'precio' => 2400,
                'categoria' => 'Papas Fritas',
                'imagen' => 'papasFinas.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 70,
            ],
            [
                'nombre' => 'Papas Fritas Gruesas Rústicas',
                'descripcion' => 'Papas con corte grueso rústico, con cáscara, doradas por fuera y tiernas por dentro, sazonadas con hierbas aromáticas.',
                'precio' => 2600,
                'categoria' => 'Papas Fritas',
                'imagen' => 'papasGruesas.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 60,
            ],

            // Empanadas
            [
                'nombre' => 'Empanada Frita de Carne',
                'descripcion' => 'Empanada frita rellena de carne vacuna cortada a cuchillo, huevo duro, cebolla de verdeo y especias criollas.',
                'precio' => 900,
                'categoria' => 'Empanadas',
                'imagen' => 'EmpanadaFrita.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 100,
            ],
            [
                'nombre' => 'Empanada de Carne al Horno',
                'descripcion' => 'Empanada horneada con masa casera, rellena de carne de res jugosa, cebolla caramelizada, aceitunas y condimento criollo.',
                'precio' => 850,
                'categoria' => 'Empanadas',
                'imagen' => 'empanadaCarne.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 100,
            ],
            [
                'nombre' => 'Empanada de Jamón y Queso al Horno',
                'descripcion' => 'Empanada horneada con abundante jamón cocido seleccionado y queso mozzarella derretido súper cremoso.',
                'precio' => 800,
                'categoria' => 'Empanadas',
                'imagen' => 'empanadaJyQ.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 120,
            ],
            [
                'nombre' => 'Empanada de Pollo al Horno',
                'descripcion' => 'Empanada horneada rellena de pechuga de pollo desmenuzada súper sabrosa, cebolla, morrón y especias.',
                'precio' => 850,
                'categoria' => 'Empanadas',
                'imagen' => 'empanadaPollo.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 90,
            ],

            // Bebidas
            [
                'nombre' => 'Coca-Cola Original 500ml',
                'descripcion' => 'Refrescante gaseosa Coca-Cola sabor original en botella de 500ml bien helada.',
                'precio' => 1200,
                'categoria' => 'Bebidas',
                'imagen' => 'bebida1.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 150,
            ],
            [
                'nombre' => 'Bebida de la casa 500ml',
                'descripcion' => 'Trago de la casa sabor a elección de 500ml.',
                'precio' => 1200,
                'categoria' => 'Bebidas',
                'imagen' => 'bebida2.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 150,
            ],
            [
                'nombre' => 'Agua mineral 500ml',
                'descripcion' => 'Agua mineral natural en botella de 500ml helada.',
                'precio' => 1000,
                'categoria' => 'Bebidas',
                'imagen' => 'bebida3.png',
                'activo' => true,
                'destacado' => false,
                'stock' => 150,
            ],
        ];

        foreach ($productos as $prod) {
            Producto::updateOrCreate(
                ['imagen' => $prod['imagen']],
                [
                    'nombre' => $prod['nombre'],
                    'descripcion' => $prod['descripcion'],
                    'precio' => $prod['precio'],
                    'categoria' => $prod['categoria'],
                    'activo' => $prod['activo'],
                    'destacado' => $prod['destacado'],
                    'stock' => $prod['stock'],
                ]
            );
        }
    }
}
