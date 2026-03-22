<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre' => 'INSTITUTO TECNOLOGICO POPULAR IGUALATORIO ANDRES IBAÑEZ',
            'nit' => '1020304050',
            'direccion' => 'AV. ROSALES, BARRIO SUAREZ PONPEYUS ZONA PLAN 3000, LADO EPI-3',
            'telefono' => '3608118',
            'ciudad' => 'SANTA CRUZ DE LA SIERRA',
        ]);
    }
}
