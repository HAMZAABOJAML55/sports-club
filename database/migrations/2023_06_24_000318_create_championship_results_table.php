<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionshipResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championship_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('championship_id')->unique()->nullable();
            $table->bigInteger('tournament_id')->unsigned()->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->bigInteger('player_id')->unsigned()->nullable();
            $table->foreign('player_id')->references('id')->on('players');
            $table->string('player_score')->nullable();
            $table->string('performance_evolution')->nullable();
            $table->string('player_notes')->nullable();

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
        Schema::dropIfExists('championship_results');
    }
}
