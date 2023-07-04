<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachHasTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public  function up()
    {
        Schema::create('coach_has_tournament', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coach_id')->unsigned();
            $table->foreign('coach_id')->references('id')->on('coachs')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('coach_has_tournament');
    }
}
