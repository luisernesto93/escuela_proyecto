<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $generos = ['M'=>'Masculino', 'F'=>'Femenino'];
        foreach ($generos as $key =>$genero){
            Genero::create([
                'genero' => $genero,
                'sigla' => $key
            ]);
        }
    }
}
