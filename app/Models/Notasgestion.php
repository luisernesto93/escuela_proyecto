<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notasgestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'gestion_id',
        'carrera_id',
        'libro_id',
        'materia_id',
        'estudiante_id',
        'docente_id',
        'nota1',
        'nota2',
        'nota3',
        'promedio',
        'prueba_recuperatoria',
        'nota_final',
        'observaciones',
        'estado',
        'usuario',
    ];

    protected $appends = ['estado_texto'];

    public function getEstadoTextoAttribute()
    {
        if ($this->estado == 1) {
            return 'ACTIVO';
        } else {
            return 'INACTIVO';
        }
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
