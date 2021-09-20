<?php

namespace Database\Factories;

use App\Models\Arena;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArenaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Arena::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       return [
            'name' => $this->faker->unique()->numerify('Arena #'),
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
