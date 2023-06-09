<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->insert([
            ['id' => '01', 'nombre' => 'COBÁN'],
            ['id' => '02', 'nombre' => 'SANTA CRUZ VERAPAZ'],
            ['id' => '03', 'nombre' => 'SAN CRISTÓBAL VERAPAZ'],
            ['id' => '04', 'nombre' => 'TACTIC'],
            ['id' => '05', 'nombre' => 'TAMAHÚ'],
            ['id' => '06', 'nombre' => 'TUCURÚ'],
            ['id' => '07', 'nombre' => 'PANZÓS'],
            ['id' => '08', 'nombre' => 'SENAHÚ'],
            ['id' => '09', 'nombre' => 'SAN PEDRO CARCHÁ'],
            ['id' => '10', 'nombre' => 'SAN JUAN CHAMELCO'],
            ['id' => '11', 'nombre' => 'LANQUÍN'],
            ['id' => '12', 'nombre' => 'CAHABÓN'],
            ['id' => '13', 'nombre' => 'CHISEC'],
            ['id' => '14', 'nombre' => 'CHAHAL'],
            ['id' => '15', 'nombre' => 'FRAY BARTOLOMÉ DE LAS CASAS'],
            ['id' => '16', 'nombre' => 'SANTA CATALINA LA TINTA'],
            ['id' => '17', 'nombre' => 'RAXRUHÁ'],
              
        ]);
    }
}
