<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sa = User::create([
            'name' => 'Super Administrador del Sistema',
            'username' => 'sa',
            'password' => bcrypt('sa'),
            'tipo'=>1,
        ]);
        $fi = User::create([
            'name' => 'Fiscal Ejemplo',
            'username' => 'fiscal',
            'password' => bcrypt('fiscal'),
            'tipo'=>2,
        ]);
        $sa = User::create([
            'name' => 'Supervisor Ejemplo',
            'username' => 'super',
            'password' => bcrypt('super'),
            'tipo'=>3,
        ]);
    }
}
