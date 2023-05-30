<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachHasTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public  function up()
    {
        Schema::create('coach_has_team', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coach_id')->unsigned();
            $table->foreign('coach_id')->references('id')->on('coachs');
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
        Schema::dropIfExists('coach_has_team');
    }
}
