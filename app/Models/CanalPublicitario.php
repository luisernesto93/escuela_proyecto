<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalPublicitario extends Model
{
    use HasFactory;
    protected $table = 'canal_publicitarios';
    protected $fillable = [
        'descripcion',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
}
