<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CanalPublicitario;

class CanalPublicitarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CanalPublicitario::create([
            'descripcion' => 'FACEBOOK',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'WHATSAPP',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'REF. ESTUDIANTE',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'TELEVISIÓN',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'RADIO',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'VOLANTE',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'FACTURA SAJUBA',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'ALUMNO ANTIGUO',
            'estado' => '1',
        ]);
        CanalPublicitario::create([
            'descripcion' => 'PUBLICIDAD PARLANTE',
            'estado' => '1',
        ]);
    }
}
