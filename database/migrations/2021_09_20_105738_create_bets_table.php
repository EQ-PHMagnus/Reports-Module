<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Fight;
use App\Models\Player;
class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fight::class);
            $table->foreignIdFor(Player::class);
            $table->enum('pick',config('defaults.picks'));
            $table->double('odds',4,2);
            $table->double('amount',12,4);
            $table->double('prize',12,4);
            $table->enum('result',config('defaults.bet_results'));
            $table->timestamp('bet_date')->nullable();
            $table->timestamp('result_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
}
