<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscriptor extends Model
{
    use HasFactory;
    protected $table = 'inscriptors';   //Tbla de la base de datos
    protected $fillable = [
        'name',
        'estado'
    ];
    protected $appends = [
        'estado_texto'
    ];

    public function getEstadoTextoAttribute()
    {
        return $this->estado == 1 ? 'ACTIVO' : 'INACTIVO';
    }
}
