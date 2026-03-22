<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;
    protected $table = 'inscripcions';
    protected $fillable = [
        'fecha_inscripcion',
        'estudiante_id',
        'gestion_id',
        'carrera_id',
        'turno_id',
        'modalidad_pago_id',
        'nro_deposito_glosa',
        'nombre_inscriptor',
        'canal_publicitario_id',
        'plazoinscripcion_id',
        'beca_id',
        'estado'
    ];
    protected $appends = ['estado_texto', 'nombre_carrera', 'nombre_turno'];

    public function getEstadoTextoAttribute()
    {
        $estado_texto = '';
        switch ($this->estado) {
            case 1:
                $estado_texto = 'ACTIVO';
                break;
            case 0:
                $estado_texto = 'INACTIVO';
                break;
        }
        return $estado_texto;
    }

    public function getNombreCarreraAttribute()
    {
        return Carrera::find($this->carrera_id)->descripcion ?? '';
    }

    public function getNombreTurnoAttribute()
    {
        return Turno::find($this->turno_id)->descripcion ?? '';
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }
    public function  modalidad_pagos()
    {
        return $this->belongsTo(ModalidadPago::class, 'modalidad_pago_id');
    }
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }
}
