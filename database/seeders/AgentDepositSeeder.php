<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentDeposit;
use App\Models\Agent;
class AgentDepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = Agent::get();
        
        foreach($agents as $agent) {
            \App\Models\AgentDeposit::factory(2)->withAgent($agent)->create();
        }
    }
}
