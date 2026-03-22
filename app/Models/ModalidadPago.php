<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadPago extends Model
{
    use HasFactory;

    protected $table = 'modalidad_pagos';

    protected $fillable = [
        'gestion_id',
        'descripcion',
        'monto_pagar',
        'estado'
    ];

    protected $attributes = [
        'estado' => 1
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
