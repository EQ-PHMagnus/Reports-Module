<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $agent_id = Cache::increment('agent_id');
        return [
            'name' => $this->faker->name(),
            'agent_id' => $agent_id ?? 2,
            // 'nickname' => $this->faker->firstName(),
            'username' => strtolower($this->faker->numerify($this->faker->firstName() . '#####')),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'mobile_number' => '09' . $this->faker->randomDigit() . $this->faker->ean8(), 
            'points' => $this->faker->numberBetween($min = 100, $max = 999999) , 
            'nationality' => 'Filipino', 
            'occupation' => $this->faker->jobTitle(), 
            'recent_photo' => 'https://picsum.photos/200/300', 
            'identification' => 'https://picsum.photos/200/300', 
            'commission' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 0.9), 
            'remember_token' => Str::random(10),
            'occupation' => $this->faker->randomElement(['employee','business owner','none']),
            'address' => $this->faker->address,
            'dob' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
            'facebook' =>$this->faker->firstName(),
            'agent_code' => $this->faker->unique()->numerify('Agent #####'),
            //Temp
            'role' => $this->faker->randomElement(config('defaults.affiliates')),
            'level' => $this->faker->numberBetween($min = 1, $max = 4),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
