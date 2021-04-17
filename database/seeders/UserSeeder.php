<?php

namespace Database\Seeders;

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
        //
        \App\Models\User::create([
            'username' => 'jamalzareie',
            'password' => bcrypt('1430548'),
        ]);

        
        \App\Models\User::create([
            'username' => 'amin',
            'password' => bcrypt('1234'),
        ]);
    }
}
