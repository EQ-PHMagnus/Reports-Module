<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Bet;
class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Bet::class)->nullable();
            $table->enum('type',config('defaults.transcation_type'));
            $table->string('signature')->nullable();
            $table->double('amount',12,4)->default(0);
            $table->text('remarks')->nullable();
            $table->unsignedInteger('approved_by')->default(1); //Remove default. Change to auth user id
            $table->enum('status',config('defaults.transcation_status'));
            $table->timestamp('approved_date')->nullable();
            $table->timestamp('transaction_date')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
