<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class PartidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partidos')->insert([
            ['nombre'=>'PARTIDO AZUL','siglas'=>'AZUL','presidente'=>2,'alcalde'=>6,'diputado'=>2],
            ['nombre'=>'BIENESTAR NACIONAL','siglas'=>'BIEN','presidente'=>21,'alcalde'=>26,'diputado'=>17],
            ['nombre'=>'CABAL','siglas'=>'CABAL','presidente'=>4,'alcalde'=>10,'diputado'=>27],
            ['nombre'=>'CAMBIO','siglas'=>'CAMBIO','presidente'=>25,'alcalde'=>16,'diputado'=>25],
            ['nombre'=>'COMPROMISO, RENOVACIÓN Y ORDEN','siglas'=>'CREO','presidente'=>20,'alcalde'=>17,'diputado'=>19],
            ['nombre'=>'COMUNIDAD ELEFANTE','siglas'=>'ELEFANTE','presidente'=>10,'alcalde'=>20,'diputado'=>14],
            ['nombre'=>'FRENTE DE CONVERGENCIA NACIONAL','siglas'=>'FCN-NACION','presidente'=>13,'alcalde'=>3,'diputado'=>3],
            ['nombre'=>'PARTIDO POLÍTICO MI FAMILIA','siglas'=>'MI FAMILIA','presidente'=>24,'alcalde'=>18,'diputado'=>21],
            ['nombre'=>'PROSPERIDAD CIUDADANA','siglas'=>'PC','presidente'=>27,'alcalde'=>7,'diputado'=>24],
            ['nombre'=>'PARTIDO HUMANISTA DE GUATEMALA','siglas'=>'PHG','presidente'=>7,'alcalde'=>24,'diputado'=>13],
            ['nombre'=>'PARTIDO DE INTEGRACIÓN NACIONAL','siglas'=>'PIN','presidente'=>9,'alcalde'=>0,'diputado'=>11],
            ['nombre'=>'PARTIDO POLÍTICO NOSOTROS','siglas'=>'PPN','presidente'=>14,'alcalde'=>12,'diputado'=>7],
            ['nombre'=>'PARTIDO REPUBLICANO','siglas'=>'PR','presidente'=>8,'alcalde'=>22,'diputado'=>16],
            ['nombre'=>'MOVIMIENTO SEMILLA','siglas'=>'SEMILLA','presidente'=>12,'alcalde'=>11,'diputado'=>26],
            ['nombre'=>'TODOS','siglas'=>'TODOS','presidente'=>5,'alcalde'=>4,'diputado'=>1],
            ['nombre'=>'UNIDAD NACIONAL DE LA ESPERANZA','siglas'=>'UNE','presidente'=>1,'alcalde'=>13,'diputado'=>4],
            ['nombre'=>'UNION REPUBLICANA','siglas'=>'UR','presidente'=>15,'alcalde'=>0,'diputado'=>15],
            ['nombre'=>'UNION REVOLUCIONARIA NACIONAL GUATEMALTECA - MOVIMINENTO POLÍTICO WINAQ','siglas'=>'URNG MAIZ - WINAQ','presidente'=>18,'alcalde'=>0,'diputado'=>0],
            ['nombre'=>'VALOR -  PARTIDO UNIONISTA','siglas'=>'VALOR - UNIONISTA','presidente'=>3,'alcalde'=>0,'diputado'=>0],
            ['nombre'=>'VALOR','siglas'=>'VALOR','presidente'=>0,'alcalde'=>8,'diputado'=>9],
            ['nombre'=>'VAMOS POR UNA GUATEMALA DIFERENTE','siglas'=>'VAMOS','presidente'=>6,'alcalde'=>1,'diputado'=>12],
            ['nombre'=>'VICTORIA','siglas'=>'VICTORIA','presidente'=>11,'alcalde'=>2,'diputado'=>5],
            ['nombre'=>'VISIÓN CON VALORES','siglas'=>'VIVA','presidente'=>22,'alcalde'=>5,'diputado'=>22],
            ['nombre'=>'VOLUNTAD, OPORTUNIDAD Y SOLIDARIDAD','siglas'=>'VOS','presidente'=>26,'alcalde'=>25,'diputado'=>20],
            ['nombre'=>'PODEMOS','siglas'=>'PODEMOS','presidente'=>0,'alcalde'=>9,'diputado'=>23],
            ['nombre'=>'MOVIMIENTO PARA LA LIBERACIÓN DE LOS PUEBLOS','siglas'=>'MLP','presidente'=>0,'alcalde'=>14,'diputado'=>6],
            ['nombre'=>'COMITÉ CÍVICO EL CHERIFÓN','siglas'=>'CHERIFÓN','presidente'=>0,'alcalde'=>19,'diputado'=>0],
            ['nombre'=>'COMITÉ CÍVICO JUSTICIA','siglas'=>'JUSTICIA','presidente'=>0,'alcalde'=>21,'diputado'=>0],
            ['nombre'=>'PARTIDO DE AVANZADA NACIONAL','siglas'=>'PAN','presidente'=>0,'alcalde'=>23,'diputado'=>8],
            ['nombre'=>'MOVIMINENTO POLÍTICO WINAQ','siglas'=>'WINAQ','presidente'=>0,'alcalde'=>15,'diputado'=>18],
            ['nombre'=>'UNION REVOLUCIONARIA NACIONAL GUATEMALTECA','siglas'=>'URNG MAIZ','presidente'=>0,'alcalde'=>0,'diputado'=>10],
            ['nombre'=>'NULOS','siglas'=>'NULOS','presidente'=>95,'alcalde'=>95,'diputado'=>95],
            ['nombre'=>'EN BLANCO','siglas'=>'EN BLANCO','presidente'=>96,'alcalde'=>96,'diputado'=>96],
            ['nombre'=>'VOTOS INVÁLIDOS','siglas'=>'EXTRAVIADOS','presidente'=>97,'alcalde'=>97,'diputado'=>97],
            ['nombre'=>'IMPUGNADOS','siglas'=>'IMPUGNADOS','presidente'=>98,'alcalde'=>98,'diputado'=>98],
            ['nombre'=>'NO UTILIZADOS','siglas'=>'NO USADOS','presidente'=>99,'alcalde'=>99,'diputado'=>99],
        ]);
    }
}
