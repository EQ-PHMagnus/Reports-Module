<?php

namespace Database\Factories;

use App\Models\Fight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fight_no' => $this->faker->randomDigit(),
            'arena_id' => \App\Models\Arena::inRandomOrder()->first()->id,
            'meron' => $this->faker->numerify('Meron ###'),
            'wala' => $this->faker->numerify('Wala ###'),
            'schedule' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
        ];
    }
}
