<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    // controller para el dashboard de admin, solo puede acceder un usuario con rol admin
    public function dashboard()
    {
        return view('/admin/dashboard');
    }
}
