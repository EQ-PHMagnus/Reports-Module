<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('mobile_number',11);
            $table->string('occupation')->nullable();
            $table->string('agent_code');
            $table->text('address')->nullable();
            $table->timestamp('dob');
            $table->string('facebook')->nullable();
            $table->bigInteger('points')->default(0);
            $table->text('identification')->nullable();
            $table->double('commission',8,4)->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            //temp
            $table->enum('role',config('defaults.affiliates'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
