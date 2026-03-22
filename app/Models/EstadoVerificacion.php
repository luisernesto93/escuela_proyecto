<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoVerificacion extends Model
{
    use HasFactory;

    protected $table = 'estado_verificacions';

    protected $fillable = [
        'estudiante_id',
        'compromiso_titulo',
        'ci_estado',
        'foto_estado',
        'folder_estado',
        'certificado_estado',
        'pago_folder_estado',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
