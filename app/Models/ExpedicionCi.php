<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedicionCi extends Model
{
    use HasFactory;
    protected $table = 'expedicion_cis';
    protected $fillable = [
        //'genero',
        'sigla',
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
