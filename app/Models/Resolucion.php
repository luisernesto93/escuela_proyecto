<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    use HasFactory;
    protected $table = 'resolucions';

    protected $fillable = [
        'numero_resolucion',
        'gestion_id',
        'carrera_id',
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
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
