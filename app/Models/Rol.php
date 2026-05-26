<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    protected static function booted(): void
    {
        static::saving(function (Rol $rol) {
            $permitidos = ['admin', 'cliente'];

            if (! in_array($rol->nombre, $permitidos, true)) {
                throw new InvalidArgumentException('El rol debe ser admin o cliente.');
            }
        });
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}
