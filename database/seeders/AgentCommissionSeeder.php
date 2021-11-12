<?php

namespace Database\Seeders;
use App\Models\Agent;

use Illuminate\Database\Seeder;
use App\Models\AgentCommission;
class AgentCommissionSeeder extends Seeder
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
            \App\Models\AgentCommission::factory(2)->withAgent($agent)->create();
        }
    }
}
