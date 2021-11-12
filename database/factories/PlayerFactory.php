<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $agent_id = Cache::increment('agent_id');
        return [
            'name'           => $this->faker->name(),
            'agent_id'       => $agent_id ?? 2,
            'username'       => strtolower($this->faker->numerify($this->faker->firstName() . '#####')),
            'email'          => $this->faker->unique()->email,
            'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',                                      // password
            'mobile_number'  => '09' . $this->faker->randomDigit() . $this->faker->ean8(),
            'points'         => $this->faker->numberBetween($min = 100, $max = 999999),
            'nationality'    => 'Filipino',
            'occupation'     => $this->faker->jobTitle(),
            'recent_photo'   => 'https://picsum.photos/200/300',
            'identification' => 'https://picsum.photos/200/300',
            'commission'     => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 0.9),
            'remember_token' => Str::random(10),
            'occupation'     => $this->faker->randomElement(['employee','business owner','none']),
            'address'        => $this->faker->address,
            'dob'            => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
            'facebook'       => $this->faker->firstName(),
            'agent_code'     => $this->faker->unique()->numerify('Agent #####'),
            //Temp
            'role'  => 'player',
            'level' => $this->faker->numberBetween($min = 1, $max = 4),
        ];
    }

    public function withAgent($id)
    {
        return $this->state([
            'agent_id' => $id
        ]);
    }
}
