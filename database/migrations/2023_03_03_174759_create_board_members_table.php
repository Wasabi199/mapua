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
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('chairman');
            $table->string('committee_chairman');
            // $table->string('benefits_chairman');
            $table->string('vice_chairman');
            $table->string('corporate_secretary');
            $table->string('treasurer');
            $table->string('internal_auditor');
            $table->string('accountant');
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
        Schema::dropIfExists('board_members');
    }
};
