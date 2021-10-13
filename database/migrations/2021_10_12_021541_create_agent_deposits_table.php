<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->double('amount',12,4);
            $table->string('source');
            $table->text('source_details');
            $table->text('remarks')->nullable();
            $table->timestamp('date_deposited')->nullable();
            $table->timestamp('date_approved')->nullable();
            $table->enum('status', ['pending','approved','rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_deposits');
    }
}
