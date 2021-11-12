<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Bet;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $transaction_types = config('defaults.transcation_type');
        $type_key          = array_rand($transaction_types,1);
        $type              = $transaction_types[$type_key];
        $amount            = $this->faker->randomFloat($nbMaxDecimals = 0, $min = 100, $max = 900);
        $signature         = bcrypt($amount);

        switch ($type) {
            case 'cash_in':
            case 'cash_out':
            case 'deposit':
            case 'withdrawal':
                $user = Player::inRandomOrder()->first();
                return [
                    'player_id'        => $user->id,
                    'type'             => $type,
                    'amount'           => $amount,
                    'signature'        => $signature,
                    'remarks'          => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                    'approved_date'    => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                    'transaction_date' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                    'status'           => $this->faker->randomElement(['pending','approved','rejected'])
                ];
                break;

            case 'earnings':
            case 'loses':
            default:
                $bet = Bet::inRandomOrder()->first();
                return [
                    'player_id' => $bet->player_id,
                    'bet_id'    => $bet->id,
                    'type'      => $type,
                    'amount'    => $amount,
                    'signature' => $signature,
                    'remarks'   => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                    'status'    => 'auto-generated'
                ];
                break;
        }
        $bet = Bet::inRandomOrder()->first();
        

        
    }
}
