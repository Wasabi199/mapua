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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('reimbursment_type');
            $table->string('clinic_name');
            $table->date('appointment_date');

            $table->string('medical_record1')->nullable();
            $table->string('medical_record2')->nullable();
            $table->string('medical_record3')->nullable();
            $table->string('medical_record4')->nullable();

            $table->integer('amount');
            $table->string('status')->default('Pending');
            $table->string('medical_benifit');

            $table->boolean('hospital')->default(false);
            $table->boolean('health')->default(false);
            $table->boolean('eye')->default(false);
            $table->boolean('dental')->default(false);
            $table->boolean('mental')->default(false);
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
        Schema::dropIfExists('medicals');
    }
};
