<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleInscripcionBeca extends Model
{
    use HasFactory;
    protected $table = 'detalle_inscripcion_becas';
    protected $fillable = [
        'inscripcion_id',
        'beca_id',
        'porcentaje',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
    public function beca()
    {
        return $this->belongsTo(Beca::class);
    }

}
