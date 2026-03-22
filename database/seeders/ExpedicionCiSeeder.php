<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExpedicionCi;

class ExpedicionCiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pais = [
            'Bolivia'=> array(
                'Santa Cruz' => 'SC',
                'Beni'=>'BN',
                'Pando'=>'PN',
                'Tarija'=>'TJ',
                'Cochambamba'=>'CB',
                'La Paz'=>'LP',
                'Chuquisaca'=>'CH',
                'Oruro'=>'OR',
                'Potosí'=>'PO'
                )
            ];
        $keyPais = array_keys($pais);
        foreach ($pais['Bolivia'] as $key =>$expedicionCi){
            ExpedicionCi::create([
                'sigla' => $expedicionCi,
                'descripcion' => $key.' - '.$keyPais[0]
            ]);
        }
    }
}
