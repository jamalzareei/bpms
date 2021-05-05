<?php

namespace Database\Seeders;

use App\Models\Pi;
use Illuminate\Database\Seeder;

class Piseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pi::factory()
            ->count(500)
            ->create();
    }
}
