<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function formularioRegistro()
    {
        return view('frontend.register');
    }

    public function formularioLogin()
    {
        return view('frontend.login');
    }

    public function registrar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo no es válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $rol = Rol::firstOrCreate(
            ['nombre' => 'cliente'],
            ['descripcion' => 'Cliente']
        );

        $usuario = Usuario::create([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'rol_id' => $rol->id,
            'remember_token' => Str::random(60),
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Tu cuenta fue creada correctamente.');
    }

    public function autenticar(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            // if (Auth::user()?->rol?->nombre === 'admin') {
            //     return redirect('/admin/dashboard');
            // }
            // usar middleware para redirigir al dashboard de admin o a la pagina de cliente segun el rol del usuario

            // return redirect('/');
        }

        return back()->withErrors([
            'email' => 'email o contraseña incorrectos',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
