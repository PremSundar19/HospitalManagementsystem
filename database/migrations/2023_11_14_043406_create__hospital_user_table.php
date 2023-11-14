<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('dob');
            $table->integer('age');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
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
        Schema::dropIfExists('_hospital_user');
    }
};
