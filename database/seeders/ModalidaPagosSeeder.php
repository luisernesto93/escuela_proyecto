<?php

namespace Database\Seeders;

use App\Models\ModalidadPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidaPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModalidadPago::create([
            'gestion_id' => 1,
            'descripcion' => 'CONTADO',
            'monto_pagar' => 0,
            'estado' => 1,
        ]);
    }
}
