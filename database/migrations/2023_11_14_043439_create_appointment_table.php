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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->string('patient_first_name',255);
            $table->string('patient_last_name',255)->nullable();
            $table->date('patient_dob');
            $table->integer('patient_age');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('doctor_name');
            $table->integer('doctor_fee');
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('appointment');
    }
};
