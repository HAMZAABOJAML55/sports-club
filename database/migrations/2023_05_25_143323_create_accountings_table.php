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
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('number');
            $table->foreignId('coach_id')->references('id')->on('coachs');
            $table->foreignId('player_id')->references('id')->on('players');
            $table->bigInteger('Payment_trainee_id')->unsigned();
            $table->foreign('Payment_trainee_id')->references('id')->on('paymentstrainees');
//            number_of_months
            $table->bigInteger('subtype_id')->unsigned();
            $table->foreign('subtype_id')->references('id')->on('subtypes');
//  نظام السحوبات
            $table->string('draws');
            $table->string('discounts');
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
