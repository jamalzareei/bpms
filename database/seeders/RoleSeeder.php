<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = \App\Models\Role::create([
            'name' => 'superadmin',
            'slug' => 'superadmin',
        ]);

        $roles->users()->sync([1, 2]);

        \App\Models\Role::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);
        \App\Models\Role::create([
            'name' => 'customer',
            'slug' => 'customer',
        ]);
        \App\Models\Role::create([
            'name' => 'operator',
            'slug' => 'operator',
        ]);
    }
}
