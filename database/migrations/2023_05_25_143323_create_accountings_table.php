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
            $table->bigInteger('coach_id')->unsigned()->nullable();
            $table->foreign('coach_id')->references('id')->on('coachs');
            $table->bigInteger('player_id')->unsigned()->nullable();
            $table->foreign('player_id')->references('id')->on('players');


            $table->bigInteger('Payment_trainee_id')->unsigned()->nullable();
            $table->foreign('Payment_trainee_id')->references('id')->on('paymentstrainees');
//            number_of_months
            #طريقة الاشتراك للمتدرب
            $table->bigInteger('subtype_id')->unsigned()->nullable();
            $table->foreign('subtype_id')->references('id')->on('subtypes');
//  نظام السحوبات
            $table->string('draws');
            $table->string('discounts');
            $table->string('total_salary')->nullable();
            $table->string('image_path')->nullable();

            $table->string('tax')->nullable();
            $table->string('deposit')->nullable();
            #نوع طريقة الدفع
            $table->string('Payment_for_trainee')->nullable();
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
