<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerHasTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public  function up()
    {
        Schema::create('player_has_tournament', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');
            $table->bigInteger('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
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
        Schema::dropIfExists('player_has_tournament');
    }
}
