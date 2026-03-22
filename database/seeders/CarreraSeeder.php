<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create([
            'nombre' => 'AGROPECUARIA',
            'codigo' => '0001',
            'nivel' => 1,
        ]);

        Carrera::create([
            'nombre' => 'COMUNICACIÓN',
            'codigo' => '0002',
            'nivel' => 1,
        ]);

        Carrera::create([
            'nombre' => 'ELECTRÓNICA',
            'codigo' => '0003',
            'nivel' => 1,
        ]);

        Carrera::create([
            'nombre' => 'INFORMÁTICA INDUSTRIAL',
            'codigo' => '0004',
            'nivel' => 1,
            'facultad_id' => 1,
        ]);

        Carrera::create([
            'nombre' => 'INDUSTRIA DE ALIMENTOS',
            'codigo' => '0005',
            'nivel' => 1,
        ]);

        Carrera::create([
            'nombre' => 'SISTEMAS INFORMÁTICOS',
            'codigo' => '0006',
            'nivel' => 1,
            'facultad_id' => 1,
        ]);

        Carrera::create([
            'nombre' => 'GASTRONOMÍA',
            'codigo' => '0007',
            'nivel' => 1,
        ]);

        Carrera::create([
            'nombre' => 'INDUSTRIA TEXTIL Y CONFECCIÓN',
            'codigo' => '0008',
            'nivel' => 1,
        ]);
    }
}
