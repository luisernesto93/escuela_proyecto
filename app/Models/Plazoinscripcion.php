<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plazoinscripcion extends Model
{
    use HasFactory;

    protected $table = 'plazoinscripcions';
    protected $fillable = [
        'gestion_id',
        'fecha_inicio',
        'fecha_limite',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }
}