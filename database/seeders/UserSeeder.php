<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user with the role of administrativo
        User::create([
            'name' => 'Administrativo',
            'email' => 'administrativo@correo.com',
            'password' => bcrypt('123456'),
        ])->assignRole('administrativo');

        // Create a user with the role of prestatario
        User::create([
            'name' => 'Prestatario',
            'email' => 'prestatario@correo.com',
            'password' => bcrypt('123456'),
        ])->assignRole('prestatario');

    }
}
