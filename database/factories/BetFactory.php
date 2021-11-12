<?php

namespace Database\Factories;

use App\Models\Bet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {      
        $fight = \App\Models\Fight::inRandomOrder()->first();

        return [
            'fight_id'    => $fight->id,
            'player_id'   => \App\Models\Player::inRandomOrder()->first(),
            'pick'        => $this->faker->randomElement(config('defaults.picks')),
            'odds'        => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 2),
            'amount'      => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 100, $max = 900),
            'prize'       => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 100, $max = 900),
            'result'      => $this->faker->randomElement(config('defaults.bet_results')),
            'bet_date'    => Carbon::parse($fight->schedule)->addDay(1)->toDateTimeString(),
            'result_date' => Carbon::parse($fight->schedule)->addDay(2)->toDateTimeString(),
        ];
    }
}
