<?php

namespace Database\Seeders;

use App\Models\Gestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentYear = Carbon::now()->year;
        Gestion::create([
            'descripcion' => 'I',
            'anio' => $currentYear
        ]);

        Gestion::create([
            'descripcion' => 'II',
            'anio' => $currentYear
        ]);
        /* $currentYear = Carbon::now()->year;
        $nroGestion = ['I','II'];
        foreach ($nroGestion as $value){
            Gestion::create([
                'descripcion' => 'Gestión '.$value,
                'anio' => $currentYear
            ]);
        } */
    }
}
