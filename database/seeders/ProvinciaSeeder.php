<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubicaciones = [
            'Bolivia'=> array(
                'Santa Cruz' => array(
                    'Andrés Ibañez','Angel Sandoval','Chiquitos','Cordillera','Florida','German Busch','Guarayos','Ichilo','Manuel Maria Caballero','Ñuflo de Chávez','Obispo Santiestevan','Sara','Vallegrande','Velasco','Warnes'),
                'Beni' => array(
                    'Cercado','Itenez','José Ballivián','Mamore','Marban','Moxos','Vaca Diez','Yacuma'),
                'Pando' => array(
                    'Abuna','Federico Román','Madre de Dios','Manuripi','Nicolás Suárez'),
                'Tarija' => array(
                    'Aniceto Arce','Aviles','Burnet O\'connor','Cercado','Gran Chaco','Méndez'),
                'Cochambamba' => array(
                    'Arani','Arque','Ayopaya','Bolívar','Campero','Capinota','Carrasco','Cercado','Chapare','Esteban Arze','German Jordán','Mizque','Punata','Quillacollo','Tapacarí','Tiraque'
                ),
                'La Paz' => array(
                    'Abel Iturralde','Aroma','Bautista Saavedra','Camacho','Caranavi','Franz Tamayo','Gualberto Villarroel','Ingavi','Inquisivi','JosÚ Manuel Pando','Larecaja','Loayza','Los Andes','Manco Kapac','Muñecas','Murillo','Nor Yungas','Omasuyos','Pacajes','Sud Yungas'
                ),
                'Chuquisaca' => array(
                    'Azurduy','Belisario Boeto','Hernando Siles','Luis Calvo','Nor Cinti','Oropeza','Sud Cinti','Tomina','Yamparaez','Zudañez'
                ),
                'Oruro' => array(
                    'Abaroa','Carangas','Cercado','Ladislao Cabrera','Litoral','Mejillones','Nor Carangas','Pantaleon Dalence','Poopo','Sabaya','Sajama','San Pedro de Totora','Saucari','Sebastißn Pagador','Sur Carangas','Tomas Barron',
                ),
                'Potosí' => array(
                    'Alonso de Ibañez','Antonio Quijarro','Bernardino Bilbao Rioja','Charcas','Chayanta','Cornelio Saavedra','Daniel Campos','Enrique Baldivieso','José Maria Linares','Modesto Omiste','Nor Chichas','Nor Lípez','Rafael Bustillo','Sur Chichas','Sur Lípez','Tomas Frias'
                )
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
            foreach ($pais as $departamentos){
                $count++;
                foreach ($departamentos as $provicias){
                    Provincia::create([
                    'nombre' => $provicias,
                    'departamento_id' => $count
                    ]);
                }
            }
            if ($key == 'Bolivia') break;
        }

    }
}
