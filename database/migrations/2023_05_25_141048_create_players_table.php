<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email' ,128)->unique();
            $table->string('password');
            $table->string('subscription_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('phone')->nullable();
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->text('player_description')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtupe')->nullable();
            $table->bigInteger('genders_id')->unsigned();
            $table->foreign('genders_id')->references('id')->on('genders')->onDelete('cascade');
            $table->bigInteger('nationalitys_id')->unsigned();
            $table->foreign('nationalitys_id')->references('id')->on('nationalitys');
            $table->bigInteger('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations');
            $table->string('postal_code')->nullable();
            $table->bigInteger('coachs_id')->unsigned();
            $table->foreign('coachs_id')->references('id')->on('coachs');
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
        Schema::dropIfExists('players');
    }
}
