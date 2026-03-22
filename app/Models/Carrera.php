<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    //
    protected $table = 'carreras';
    protected $fillable = [
        'nombre', 'codigo', 'estado', 'facultad_id', 'nivel'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }
}
