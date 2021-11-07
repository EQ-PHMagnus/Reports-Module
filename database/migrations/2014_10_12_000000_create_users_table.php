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
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('mobile_number',11);
            $table->string('occupation')->nullable();
            $table->string('agent_code')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->string('facebook')->nullable();
            $table->bigInteger('points')->default(0);
            $table->text('recent_photo')->nullable();
            $table->text('identification')->nullable();
            $table->double('commission',12,4)->default(0);
            $table->integer('added_by')->default(0);
            $table->timestamp('deactivated_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            //temp
            $table->string('role')->nullable();
            $table->unsignedInteger('level')->default(1);
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
