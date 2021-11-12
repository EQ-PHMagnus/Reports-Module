<?php

namespace Database\Factories;

use App\Models\AgentCommission;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentCommissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgentCommission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'super_agent_id'    => $agentRole == 'agent' ? $agent->agent_id : NULL,
            'fight_id'          => \App\Models\Fight::inRandomOrder()->first(),
            'bet_id'            => \App\Models\Bet::inRandomOrder()->first(),
            'commission'        => $this->faker->numerify('###.##'),
            'amount'            => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 100, $max = 900),
            'commission_date'   => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            // 'type'              => $agentRole,
            'level'             => $this->faker->sentence($nbWords = 4, $variableNbWords = true),

        ];
    }

    public function withAgent($agent)
    {
        return $this->state([
            'agent_id'       => $agent->id,
            'super_agent_id' => $agent->role == 'agent' ? $agent->agent_id : NULL,
            'type'           => $agent->role
        ]);
    }
}
