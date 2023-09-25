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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('civil_status');


            
            // $table->string('region');
            // $table->string('province');
            // $table->string('municipality');
            // $table->string('barangay');
            // $table->string('current_address');
           
            $table->string('department');
            $table->string('salary')->nullable();
            $table->date('membership');
            $table->date('employment');
            // $table->string('total_contribution')->default(0);
            $table->string('current_loan')->nullable();
            
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
        Schema::dropIfExists('admins');
    }
};
