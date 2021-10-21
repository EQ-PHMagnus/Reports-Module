<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentDeposit;
class AgentDepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AgentDeposit::factory(20)->create();
    }
}
