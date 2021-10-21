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
            RolesAndPermissions::class,
            UserSeeder::class,
        ]);

        \App\Models\User::factory(20)->create();
        \App\Models\Arena::factory(10)->create();
        \App\Models\Fight::factory(20)->create();
        \App\Models\Bet::factory(20)->create();
        \App\Models\Transaction::factory(20)->create();

        $this->call([
            AgentDepositSeeder::class,
        ]);


        Cache::flush();
    }
}
