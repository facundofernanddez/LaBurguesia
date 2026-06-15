<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Contacto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear roles si no existen
        $rolCliente = Rol::firstOrCreate(
            ['nombre' => 'cliente'],
            ['descripcion' => 'Cliente']
        );

        $rolAdmin = Rol::firstOrCreate(
            ['nombre' => 'admin'],
            ['descripcion' => 'Administrador']
        );

        // 2. Crear usuarios
        // Admin principal
        $admin1 = Usuario::updateOrCreate(
            ['email' => 'facundofernanddez@gmail.com'],
            [
                'nombre' => 'Alejandro Facundo',
                'password' => Hash::make('password'),
                'rol_id' => $rolAdmin->id,
                'activo' => true,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // Admin secundario de prueba
        $admin2 = Usuario::updateOrCreate(
            ['email' => 'admin@laburguesia.com'],
            [
                'nombre' => 'Admin de Prueba',
                'password' => Hash::make('admin123'),
                'rol_id' => $rolAdmin->id,
                'activo' => true,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // Clientes
        $cliente1 = Usuario::updateOrCreate(
            ['email' => 'pepe@example.com'],
            [
                'nombre' => 'Pepe Pérez',
                'password' => Hash::make('password'),
                'rol_id' => $rolCliente->id,
                'activo' => true,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        $cliente2 = Usuario::updateOrCreate(
            ['email' => 'guada@example.com'],
            [
                'nombre' => 'Guadalupe Aymara',
                'password' => Hash::make('password'),
                'rol_id' => $rolCliente->id,
                'activo' => true,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        $cliente3 = Usuario::updateOrCreate(
            ['email' => 'juan@example.com'],
            [
                'nombre' => 'Juan Gómez',
                'password' => Hash::make('password'),
                'rol_id' => $rolCliente->id,
                'activo' => true,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // 3. Crear compras/ventas
        // Limpiar ventas previas para evitar duplicaciones al re-sembrar
        Venta::query()->delete();

        // Obtener algunos productos reales creados en el ProductSeeder
        $pBacon = Producto::where('nombre', 'Bacon Burger Simple')->first();
        $pPapas = Producto::where('nombre', 'Papas Fritas Cheddar y Bacon')->first();
        $pComboClass = Producto::where('nombre', 'Combo Clásico La Burguesía')->first();
        $pAgua = Producto::where('nombre', 'Agua mineral 500ml')->first();
        $pPremium = Producto::where('nombre', 'Hamburguesa La Burguesía Premium')->first();
        $pCola = Producto::where('nombre', 'Coca-Cola Original 500ml')->first();

        if ($pBacon && $pPapas && $pComboClass && $pAgua && $pPremium && $pCola) {
            // Venta 1: Pepe Pérez (Delivery)
            $venta1 = Venta::create([
                'usuario_id' => $cliente1->id,
                'metodo_entrega' => 'delivery',
                'direccion' => 'Av. San Martín 1540, Corrientes',
                'forma_pago' => 'tarjeta',
                'costo_envio' => 1000,
                'total' => $pBacon->precio + $pPapas->precio + 1000,
                'created_at' => now()->subDays(3),
            ]);

            VentaDetalle::create([
                'venta_id' => $venta1->id,
                'producto_id' => $pBacon->id,
                'cantidad' => 1,
                'precio_unitario' => $pBacon->precio,
            ]);

            VentaDetalle::create([
                'venta_id' => $venta1->id,
                'producto_id' => $pPapas->id,
                'cantidad' => 1,
                'precio_unitario' => $pPapas->precio,
            ]);

            // Venta 2: Pepe Pérez (Take Away)
            $venta2 = Venta::create([
                'usuario_id' => $cliente1->id,
                'metodo_entrega' => 'take_away',
                'direccion' => null,
                'forma_pago' => 'efectivo',
                'costo_envio' => 0,
                'total' => $pComboClass->precio + $pAgua->precio,
                'created_at' => now()->subDays(1),
            ]);

            VentaDetalle::create([
                'venta_id' => $venta2->id,
                'producto_id' => $pComboClass->id,
                'cantidad' => 1,
                'precio_unitario' => $pComboClass->precio,
            ]);

            VentaDetalle::create([
                'venta_id' => $venta2->id,
                'producto_id' => $pAgua->id,
                'cantidad' => 1,
                'precio_unitario' => $pAgua->precio,
            ]);

            // Venta 3: Guadalupe Aymara (Take Away)
            $venta3 = Venta::create([
                'usuario_id' => $cliente2->id,
                'metodo_entrega' => 'take_away',
                'direccion' => null,
                'forma_pago' => 'transferencia',
                'costo_envio' => 0,
                'total' => $pPremium->precio + $pCola->precio,
                'created_at' => now()->subHours(5),
            ]);

            VentaDetalle::create([
                'venta_id' => $venta3->id,
                'producto_id' => $pPremium->id,
                'cantidad' => 1,
                'precio_unitario' => $pPremium->precio,
            ]);

            VentaDetalle::create([
                'venta_id' => $venta3->id,
                'producto_id' => $pCola->id,
                'cantidad' => 1,
                'precio_unitario' => $pCola->precio,
            ]);
        }

        // 4. Crear consultas de contacto (algunas respondidas, otras pendientes)
        // Consulta 1 (Respondida)
        Contacto::updateOrCreate(
            [
                'email' => 'pepe@example.com',
                'mensaje' => 'Hola, ¿llegan hasta el barrio San Gerónimo para el envío a domicilio?'
            ],
            [
                'nombre' => 'Pepe Pérez',
                'motivo' => 'Envío / Delivery',
                'respondido' => true,
                'respuesta' => 'Hola Pepe, ¡sí! Llegamos a todos los barrios dentro de la ciudad de Corrientes. El envío tiene un costo fijo de $1000. ¡Esperamos tu compra!',
                'created_at' => now()->subDays(4),
            ]
        );

        // Consulta 2 (Pendiente)
        Contacto::updateOrCreate(
            [
                'email' => 'marta@example.com',
                'mensaje' => 'Hola, quería consultar si tienen opciones de hamburguesas aptas para celíacos (sin TACC). Gracias.'
            ],
            [
                'nombre' => 'Marta Gómez',
                'motivo' => 'Menú / Ingredientes',
                'respondido' => false,
                'respuesta' => null,
                'created_at' => now()->subDays(2),
            ]
        );

        // Consulta 3 (Respondida)
        Contacto::updateOrCreate(
            [
                'email' => 'juan@example.com',
                'mensaje' => 'Buenas tardes. ¿Se pueden reservar mesas para cumpleaños o eventos privados?'
            ],
            [
                'nombre' => 'Juan Gómez',
                'motivo' => 'Reservas / Eventos',
                'respondido' => true,
                'respuesta' => 'Hola Juan. Por el momento solo trabajamos con modalidad Take Away y Delivery, por lo que no contamos con salón para eventos o reservas. ¡Saludos!',
                'created_at' => now()->subDays(6),
            ]
        );

        // Consulta 4 (Pendiente)
        Contacto::updateOrCreate(
            [
                'email' => 'lucia@example.com',
                'mensaje' => 'Hola, ayer hice un pedido y me llegó una gaseosa común en vez de una light. ¿Cómo podemos hacer el cambio?'
            ],
            [
                'nombre' => 'Lucía Fernández',
                'motivo' => 'Reclamo / Pedidos',
                'respondido' => false,
                'respuesta' => null,
                'created_at' => now()->subHours(12),
            ]
        );
    }
}
