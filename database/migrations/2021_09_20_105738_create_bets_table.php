<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Fight;
use App\Models\User;
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
            $table->foreignIdFor(User::class);
            $table->string('pick');
            $table->double('odds',4,2);
            $table->double('amount',12,4);
            $table->double('prize',12,4);
            $table->enum('result',['WAITING','DEFEATED','WINNING']);
            $table->timestamp('bet_date');
            $table->timestamp('result_date');
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
