<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountings', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('number_of_months');
            $table->foreignId('coach_id')->references('id')->on('coachs');
            $table->foreignId('player_id')->references('id')->on('players');
            $table->string('discounts');
//  نظام السحوبا
            $table->string('draws');
            $table->string('Payments_trainees');
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
        Schema::dropIfExists('accountings');
    }
}
