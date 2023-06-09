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
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(CentrosVotacionSeeder::class);
        $this->call(PartidosSeeder::class);
    }
}