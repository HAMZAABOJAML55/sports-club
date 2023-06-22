<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('foodsystem_id')->unsigned();
            $table->foreign('foodsystem_id')->references('id')->on('foodsystems');
            $table->integer('number');
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->string('components_of_the_diet')->nullable();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
//            $table->foreign('components_id')->references('id')->on('components');
            $table->date('start_time');
            $table->date('end_time');
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
        Schema::dropIfExists('food');
    }
}
