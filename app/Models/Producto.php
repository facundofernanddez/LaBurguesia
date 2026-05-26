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
    ];

    protected $casts = [
        'activo' => 'boolean',
        'precio' => 'integer',
    ];
}
