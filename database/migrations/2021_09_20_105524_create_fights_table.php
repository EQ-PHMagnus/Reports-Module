<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->integer('arena_id');
            $table->string('meron');
            $table->string('meron_lb')->nullable();
            $table->string('meron_wb')->nullable();
            $table->string('meron_wt')->nullable();
            $table->string('wala');
            $table->string('wala_lb')->nullable();
            $table->string('wala_wb')->nullable();
            $table->string('wala_wt')->nullable();
            $table->timestamp('schedule');
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
        Schema::dropIfExists('fights');
    }
}
