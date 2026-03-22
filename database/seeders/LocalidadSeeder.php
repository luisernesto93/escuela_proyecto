<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Localidad;

class LocalidadSeeder extends Seeder
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
                'Santa Cruz' => array(
                    'Andrés Ibañez' => array(
                        'Santa Cruz de la Sierra'),
                    'Angel Sandoval' => array(
                        'San Matías'),
                    'Chiquitos' => array(
                        'San José'),
                    'Cordillera' => array(
                        'Lagunillas'),
                    'Florida' => array(
                        'Samaipata'),
                    'German Busch' => array(
                        'Puerto Suárez'),
                    'Guarayos' => array(
                        'Ascensión'),
                    'Ichilo' => array(
                        'Buena Vista'),
                    'Manuel Maria Caballero' => array(
                        'Comarapa'),
                    'Ñuflo de Chávez' => array(
                        'Concepción'),
                    'Obispo Santiestevan' => array(
                        'Montero'),
                    'Sara' => array(
                        'Portachuelo'),
                    'Vallegrande' => array(
                        'Vallegrande'),
                    'Velasco' => array(
                        'San Ignacio'),
                    'Warnes' => array(
                        'Warnes')),
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
                    'Abel Iturralde','Aroma','Bautista Saavedra','Camacho','Caranavi','Franz Tamayo','Gualberto Villarroel','Ingavi','Inquisivi','José Manuel Pando','Larecaja','Loayza','Los Andes','Manco Kapac','Muñecas','Murillo','Nor Yungas','Omasuyos','Pacajes','Sud Yungas'
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
        foreach ($ubicaciones['Bolivia'] as $key => $departamentos){
            foreach ($departamentos as $provicias){
                $count++;
                foreach ($provicias as $localidades){
                    Localidad::create([
                    'nombre' => $localidades,
                    'provincia_id' => $count
                    ]);
                }
            }
            if ($key == 'Santa Cruz') break;
        }
    }
}
