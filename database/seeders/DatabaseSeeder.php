<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cita;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Cita::factory(10)->create();
    }
}
