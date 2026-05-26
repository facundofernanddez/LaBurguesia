<?php

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('clientes cannot access the admin dashboard', function () {
    $adminRol = Rol::create([
        'nombre' => 'admin',
        'descripcion' => 'Administrador',
    ]);

    $clientRol = Rol::create([
        'nombre' => 'cliente',
        'descripcion' => 'Cliente regular',
    ]);

    $admin = Usuario::create([
        'nombre' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => 'password123',
        'remember_token' => Str::random(60),
        'rol_id' => $adminRol->id,
    ]);

    $client = Usuario::create([
        'nombre' => 'Client User',
        'email' => 'client@example.com',
        'password' => 'password123',
        'remember_token' => Str::random(60),
        'rol_id' => $clientRol->id,
    ]);

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk();

    $this->actingAs($client)
        ->get('/admin/dashboard')
        ->assertRedirect('/');
});
