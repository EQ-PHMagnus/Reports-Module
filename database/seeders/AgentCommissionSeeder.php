<?php

namespace Database\Seeders;

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
        \App\Models\AgentCommission::factory(20)->create();
    }
}
