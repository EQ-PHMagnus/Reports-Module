<?php

namespace Database\Factories;

use App\Models\AgentDeposit;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentDepositFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgentDeposit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            // 'agent_id'       =>  \App\Models\User::inRandomOrder()->first()->id,
            'amount'         =>  $this->faker->randomFloat($nbMaxDecimals = 0, $min = 100, $max = 900),
            'source'         =>  $this->faker->randomElement(['Bank Transfer','E - Wallet']),
            'source_details' =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'remarks'        =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'date_deposited' =>  $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'date_approved'  =>  $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'status'         =>  $this->faker->randomElement(['pending','approved','rejected'])

        ];
    }

    public function withAgent($agent)
    {
        return $this->state([
            'agent_id'       => $agent->id,
            'super_agent_id' => $agent->role == 'agent' ? $agent->agent_id : NULL
        ]);
    }
}
