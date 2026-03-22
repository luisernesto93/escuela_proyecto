<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
    protected $fillable = [
        'documento',
        //'expedicion',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        //'genero',
        'localidad_id',
        'genero_id',
        'expedicion_ci_id',
        //'nacionalidad',
        'direccion',
        'telefono',
        'correo',
        'nombre_referencia',
        'telefono_referencia',
        'fecha_registro',
        'estado',
    ];

    protected $attributes = [
        'estado' => 1,
    ];

    protected $appends = ['estado_texto', 'departamento_texto', 'genero_texto']/*, 'provincia_texto', 'localidad_texto']*/;

    public function getEstadoTextoAttribute() //Cada Appendes necesita una funcion get
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
    public function getGeneroTextoAttribute()
    {
        $genero_texto = '';
        switch ($this->genero) {
            case "M":
                $genero_texto = 'MASCULINO';
                break;
            case "F":
                $genero_texto = 'FEMENINO';
                break;
        }
        return $genero_texto;
    }

    public function getDepartamentoTextoAttribute()
    {
        $departemento_texto = '';
        switch ($this->departamento) {
            case 'SC':
                $departemento_texto = 'SANTA CRUZ';
                break;
            case 'LP':
                $departemento_texto = 'LA PAZ';
                break;
            case 'CB':
                $departemento_texto = 'COCHABAMBA';
                break;
            case 'OR':
                $departemento_texto = 'ORURO';
                break;
            case 'PT':
                $departemento_texto = 'POTOSI';
                break;
            case 'CH':
                $departemento_texto = 'CHUQUISACA';
                break;
            case 'TJ':
                $departemento_texto = 'TARIJA';
                break;
            case 'BE':
                $departemento_texto = 'BENI';
                break;
            case 'PD':
                $departemento_texto = 'PANDO';
                break;
        }
        return $departemento_texto;
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
    public function expedicion_ci()
    {
        return $this->belongsTo(ExpedicionCi::class);
    }
}
