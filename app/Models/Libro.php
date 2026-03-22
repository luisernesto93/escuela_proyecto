<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros';
    protected $fillable = [
        'gestion_id',
        'nro_libro',
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

    public function notasgestions()
    {
        return $this->hasMany(Notasgestion::class);
    }
}
