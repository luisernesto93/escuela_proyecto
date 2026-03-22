<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Docente::create([
            'codigo_interno' => '0001',
            'nombres' => 'JUAN',
            'apellidos' => 'PEREZ',
            'documento' => '1234567',
            'telefono' => '1234567',
            'observaciones' => 'NINGUNA',
            'estado' => 1,
        ]);
    }
}
