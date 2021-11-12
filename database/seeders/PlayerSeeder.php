<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = Agent::where('role', 'agent')->get();
        
        // add 5 players for each agent
        foreach($agents as $agent) {
            \App\Models\Player::factory(5)->withAgent($agent->id)->create();
        }
    }
}
