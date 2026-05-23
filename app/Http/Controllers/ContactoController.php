<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // manejo de formulario de contacto
    public function contacto(Request $request)
    {

        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $motivo = $request->input('motivo');
        $mensaje = $request->input('mensaje');

        // validar formulario

    }
}
