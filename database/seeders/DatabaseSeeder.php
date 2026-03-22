<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() //Aquí se  deben registrar todos los seeders
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            FacultadSeeder::class,
            CarreraSeeder::class,
            TurnosSeeder::class,
            BecasSeeder::class,
            CanalPublicitarioSeeder::class,
            PaisSeeder::class,
            DepartamentoSeeder::class,
            ProvinciaSeeder::class,
            LocalidadSeeder::class, //instanciando el
            GeneroSeeder::class,
            ExpedicionCiSeeder::class,
            GestionSeeder::class,
            ModalidaPagosSeeder::class,
            DocenteSeeder::class,
            EmpresaSeeder::class,
            LibroSeeder::class,
            MateriaSeeder::class,
        ]);
    }
}
