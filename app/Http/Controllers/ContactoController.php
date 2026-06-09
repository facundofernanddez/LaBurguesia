<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Mail\ConsultaRecibida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    // manejo de formulario de contacto
    public function contacto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'motivo' => 'required|string|max:150',
            'mensaje' => 'required|string|max:1000',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no puede superar los :max caracteres.',
            
            'motivo.required' => 'El motivo de la consulta es obligatorio.',
            'motivo.string' => 'El motivo debe ser texto.',
            'motivo.max' => 'El motivo no puede superar los :max caracteres.',
            
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.string' => 'El mensaje debe ser texto.',
            'mensaje.max' => 'El mensaje no puede superar los :max caracteres.',
        ]);

        try {
            // Crear la consulta
            $contacto = Contacto::create($validated);
            
            // Enviar email de confirmación al usuario
            Mail::to($validated['email'])->send(new ConsultaRecibida($contacto));
            
            return redirect()->back()->with('success', '¡Mensaje enviado con éxito! Nos contactaremos pronto.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado al enviar el mensaje. Intente de nuevo.');
        }
    }
}
