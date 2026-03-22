<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'materias';

    protected $fillable = [
        'plan_estudio_id',
        'carrera_id',
        'sigla',
        'nombre_materia',
        'horas',
        'nivel',
        'orden',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
    public function plan_estudio()
    {
        return $this->belongsTo(Planestudio::class);
    }
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
