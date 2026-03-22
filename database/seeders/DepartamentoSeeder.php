<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamento;
class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ubicaciones = [
            'Bolivia'=> array(
                'Santa Cruz','Beni','Pando','Tarija','Cochambamba','La Paz','Chuquisaca','Oruro','Potosí'
                ),
            'Perú',
            'Brasil',
            'Colombia',
            'Venezuela',
            'Chile',
            'Argentina',
            'Paraguay',
            'Uruguay',
            'Cuba',
            'España',
            'China',
            'Japón',
            'Rusia'
        ];
        $count = 0;
        foreach ($ubicaciones as $key => $pais){
            $count++;
            foreach ($pais as $departamento){
                Departamento::create([
                'nombre' => $departamento,
                'pais_id' => $count
                ]);
            }
            if ($key == 'Bolivia') break;
        }

    }
}
