<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('name');
            $table->string('number');
            $table->text('description');
            $table->bigInteger('training_group_id')->unsigned();
            $table->foreign('training_group_id')->references('id')->on('training_groups');
            $table->string('link_website')->nullable();
            $table->string('duration_of_training');
            $table->string('training_number');
            $table->string('image_path')->nullable();
            $table->string('number_of_iterations');

            //عدد التكرارت
            // $table->string('Number_of_repetitions');
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
        Schema::dropIfExists('trainees');
    }
}
