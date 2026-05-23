<?php

namespace App\Models;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [password => 'hashed'];
    }

    public function rol()
    {
        $this->belongsTo(Rol::class, 'rol_id');
    }
}
