<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', '0'); // for infinite time of execution 

        $this->call([
            // RolesAndPermissions::class,
        ]);

        \App\Models\User::factory(1000)->create();
        \App\Models\Arena::factory(10)->create();
        \App\Models\Fight::factory(100)->create();
        \App\Models\Bet::factory(1000)->create();
        \App\Models\Transaction::factory(1000)->create();

        Cache::flush();
    }
}
