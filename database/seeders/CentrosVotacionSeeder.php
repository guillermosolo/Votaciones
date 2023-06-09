<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentrosVotacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centro_votacion')->insert([
            ['id'=>1,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL URBANA PARA NIÑAS NÚMERO 2 JOSEFA JACINTO','JRV'=>12,'empadronados'=>4800,'sector'=>'U'],
            ['id'=>2,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL URBANA PARA VARONES No. 1 VICTOR CHAVARRIA','JRV'=>18,'empadronados'=>7200,'sector'=>'U'],
            ['id'=>3,'municipio_id'=>1,'nombre'=>'ESCUELA NACIONAL DE CIENCIAS COMERCIALES','JRV'=>20,'empadronados'=>8000,'sector'=>'U'],
            ['id'=>4,'municipio_id'=>1,'nombre'=>'ESCUELA DE PÁRVULOS ADOLFO LEAL KLUG "TITO LEAL"','JRV'=>8,'empadronados'=>2927,'sector'=>'U'],
            ['id'=>5,'municipio_id'=>1,'nombre'=>'CENTRO UNIVERSITARIO DEL NORTE CUNOR','JRV'=>3,'empadronados'=>810,'sector'=>'U'],
            ['id'=>6,'municipio_id'=>1,'nombre'=>'ESCUELA CANTON LAS CASAS','JRV'=>13,'empadronados'=>5200,'sector'=>'U'],
            ['id'=>7,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL URBANA PARA VARONES No. 2 SALVADOR DE OLIVA','JRV'=>7,'empadronados'=>2633,'sector'=>'U'],
            ['id'=>8,'municipio_id'=>1,'nombre'=>'INMN EMILIO ROSALES PONCE','JRV'=>14,'empadronados'=>6180,'sector'=>'U'],
            ['id'=>9,'municipio_id'=>1,'nombre'=>'CENTRO CIUDAD DE LA ESPERANZA','JRV'=>20,'empadronados'=>7916,'sector'=>'U'],
            ['id'=>10,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL URBANA MIXTA EL ESFUERZO','JRV'=>14,'empadronados'=>5600,'sector'=>'U'],
            ['id'=>11,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA PETET','JRV'=>15,'empadronados'=>5841,'sector'=>'U'],
            ['id'=>12,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA, " ROSAURA BELLAMAR IBANEZ WINTER DE SIERRA"','JRV'=>7,'empadronados'=>2722,'sector'=>'U'],
            ['id'=>13,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA AIDA MARTINEZ','JRV'=>8,'empadronados'=>2840,'sector'=>'U'],

            ['id'=>14,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA FINCA CHOVAL O CHOBAL','JRV'=>16,'empadronados'=>5976,'sector'=>'R'],
            ['id'=>15,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA CASERÍO SACOCPUR','JRV'=>15,'empadronados'=>5638,'sector'=>'R'],
            ['id'=>16,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA CASERÍO SALACUIN','JRV'=>7,'empadronados'=>2659,'sector'=>'R'],
            ['id'=>17,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTO ALDEA BALBATZUL I','JRV'=>23,'empadronados'=>8716,'sector'=>'R'],
            ['id'=>18,'municipio_id'=>1,'nombre'=>'ESCUELA DE AUTOGESTION FINCA SAJACOC O NIMLAJACOC','JRV'=>12,'empadronados'=>4204,'sector'=>'R'],
            ['id'=>19,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA ALDEA SANTA LUCIA LACHUA','JRV'=>12,'empadronados'=>4497,'sector'=>'R'],
            ['id'=>20,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA CASERÍO SAN LUCAS SEMOX','JRV'=>20,'empadronados'=>7392,'sector'=>'R'],
            ['id'=>21,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA ALDEA SAXOC','JRV'=>14,'empadronados'=>5142,'sector'=>'R'],
            ['id'=>22,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA CASERÍO EL ROSARIO','JRV'=>6,'empadronados'=>2352,'sector'=>'R'],
            ['id'=>23,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA ALDEA SAMAC','JRV'=>4,'empadronados'=>1338,'sector'=>'R'],
            ['id'=>24,'municipio_id'=>1,'nombre'=>'ESCUELA OFICIAL RURAL MIXTA ALDEA COXOPUR','JRV'=>8,'empadronados'=>2713,'sector'=>'R'],
        ]);
    }
}
