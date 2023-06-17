<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('name');
            $table->string('number');
            $table->text('description');
            $table->date('start_time');
            $table->date('end_time');
            $table->bigInteger('tournament_type_id')->unsigned();
            $table->foreign('tournament_type_id')->references('id')->on('tournament_types');
            $table->bigInteger('prize_type_id')->unsigned();
            $table->foreign('prize_type_id')->references('id')->on('prizes');
            $table->bigInteger('championship_levels_id')->unsigned();
            $table->foreign('championship_levels_id')->references('id')->on('championship_levels');

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
        Schema::dropIfExists('tournaments');
    }
}
