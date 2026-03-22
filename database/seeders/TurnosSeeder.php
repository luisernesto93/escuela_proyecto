<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Turno;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::create([
            'descripcion' => 'MAÑANA',
        ]);

        Turno::create([
            'descripcion' => 'TARDE',
        ]);

        Turno::create([
            'descripcion' => 'NOCHE',
        ]);
    }
}
