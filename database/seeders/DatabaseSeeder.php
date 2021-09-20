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
        \App\Models\User::factory(100)->create();
        \App\Models\Arena::factory(10)->create();
        \App\Models\Fight::factory(10)->create();
        \App\Models\Bet::factory(1000)->create();
    }
}
