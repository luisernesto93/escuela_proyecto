<?php

namespace Database\Seeders;

use App\Models\Beca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beca::create([
            'descripcion' => 'SIN BECA',
            'porcentaje' => '0',
        ]);

        Beca::create([
            'descripcion' => 'BECADO',
            'porcentaje' => '25',
        ]);

        Beca::create([
            'descripcion' => 'BECADO',
            'porcentaje' => '50',
        ]);

        Beca::create([
            'descripcion' => 'BECADO',
            'porcentaje' => '100',
        ]);
    }
}
