<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'imagen',
        'activo',
        'stock',
        'destacado',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'destacado' => 'boolean',
        'precio' => 'integer',
        'stock' => 'integer',
    ];
}
