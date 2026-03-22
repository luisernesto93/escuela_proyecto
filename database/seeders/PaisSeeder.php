<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paises = ['Bolivia','Perú','Brasil','Colombia','Venezuela','Chile','Argentina','Paraguay','Uruguay','Cuba','España','China','Japón','Rusia'];
        foreach ($paises as $pais){
            Pais::create([
                'nombre' => $pais
            ]);
        }
    }
}
