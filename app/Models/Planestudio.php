<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planestudio extends Model
{
    use HasFactory;
    protected $table = 'planestudios';
    protected $fillable = [
        'resolucion_id',
        'area_formacion',
        'horas_semanales',
        'horas_mes',
        'horas_gestion',
        'carga_horaria',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
    public function resolucion()
    {
        return $this->belongsTo(Resolucion::class);
    }
}
