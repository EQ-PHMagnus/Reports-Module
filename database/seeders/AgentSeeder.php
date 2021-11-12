<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Agent::factory(5)->superagents()->create();

        $super_agents = Agent::all();

        // create 3 agent under each super agent
        foreach($super_agents as $super_agent) {
            \App\Models\Agent::factory(3)->agents($super_agent->id)->create();
        }
    }
}
