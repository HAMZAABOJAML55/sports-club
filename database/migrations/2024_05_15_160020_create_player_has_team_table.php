<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerHasTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public  function up()
    {
        Schema::create('player_has_team', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');
            $table->bigInteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('player_has_team');
    }
}
