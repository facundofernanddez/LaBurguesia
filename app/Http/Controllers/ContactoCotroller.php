<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoCotroller extends Controller
{
    //manejo de formulario de contacto
    public function contacto(Request $request){
        //sin validar el formulario
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('mensaje');

        alert(nombre: $nombre, email: $email, mensaje: $mensaje);
    }
}
