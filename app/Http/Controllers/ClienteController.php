<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function comprar(Request $request)
    {
        if (auth()->user()?->rol?->nombre === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Los administradores no pueden realizar compras.'
            ], 403);
        }

        $validated = $request->validate([
            'carrito' => 'required|array|min:1',
            'metodo_entrega' => 'required|string|in:take_away,delivery',
            'direccion' => 'required_if:metodo_entrega,delivery|nullable|string|max:255',
            'forma_pago' => 'required|string|in:efectivo,tarjeta,transferencia',
        ], [
            'metodo_entrega.required' => 'El método de entrega es obligatorio.',
            'metodo_entrega.in' => 'El método de entrega no es válido.',
            'direccion.required_if' => 'La dirección es obligatoria para envío a domicilio.',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres.',
            'forma_pago.required' => 'La forma de pago es obligatoria.',
            'forma_pago.in' => 'La forma de pago seleccionada no es válida.',
        ]);

        try {
            DB::beginTransaction();

            $costoEnvio = ($validated['metodo_entrega'] === 'delivery') ? 1000 : 0;
            $total = $costoEnvio;
            $itemsToProcess = [];

            foreach ($validated['carrito'] as $item) {
                $producto = Producto::find($item['id']);

                if (!$producto) {
                    throw new \Exception("El producto ya no está disponible.");
                }

                // Si por alguna razón no está activo
                if (!$producto->activo) {
                    throw new \Exception("El producto '{$producto->nombre}' ya no está activo para su venta.");
                }

                $cantidad = isset($item['cantidad']) ? (int)$item['cantidad'] : 1;

                if ($producto->stock < $cantidad) {
                    throw new \Exception("Stock insuficiente para: {$producto->nombre} (Quedan: {$producto->stock})");
                }

                $precioUnitario = $producto->precio;
                $total += $precioUnitario * $cantidad;

                $itemsToProcess[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                ];
            }

            // Registrar la venta
            $venta = Venta::create([
                'usuario_id' => auth()->id(),
                'total' => $total,
                'metodo_entrega' => $validated['metodo_entrega'],
                'direccion' => $validated['metodo_entrega'] === 'delivery' ? $validated['direccion'] : null,
                'forma_pago' => $validated['forma_pago'],
                'costo_envio' => $costoEnvio,
            ]);

            // Registrar los detalles de la venta y actualizar stock
            foreach ($itemsToProcess as $processItem) {
                $prod = $processItem['producto'];
                $cant = $processItem['cantidad'];
                $pu = $processItem['precio_unitario'];

                // Descontar del stock
                $prod->stock -= $cant;
                $prod->save();

                // Crear detalle
                VentaDetalle::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $prod->id,
                    'cantidad' => $cant,
                    'precio_unitario' => $pu,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '¡Compra realizada con éxito!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function perfil(Request $request)
    {
        $usuario = auth()->user();
        $usuario->load('rol');

        $compras = Venta::where('usuario_id', $usuario->id)
            ->with('detalles.producto')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.perfil', compact('usuario', 'compras'));
    }

    public function updatePerfil(Request $request)
    {
        $usuario = auth()->user();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede superar los :max caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado por otro usuario.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $updateData = [
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }

        $usuario->update($updateData);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
