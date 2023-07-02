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
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email' ,128)->unique();
            $table->string('password');
            $table->string('subscription_number');
            $table->date('date_of_birth')->nullable();
            $table->text('phone');
            $table->text('player_description')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtupe')->nullable();
            $table->bigInteger('profs_id')->unsigned();
            $table->foreign('profs_id')->references('id')->on('profs');
            $table->bigInteger('subtype_id')->unsigned();
            $table->foreign('subtype_id')->references('id')->on('subtypes');
            $table->bigInteger('genders_id')->unsigned();
            $table->foreign('genders_id')->references('id')->on('genders')->onDelete('cascade');
            $table->bigInteger('nationality_id')->unsigned();
            $table->foreign('nationality_id')->references('id')->on('nationalitys');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->bigInteger('sub_location_id')->unsigned();
            $table->foreign('sub_location_id')->references('id')->on('sub_locations');
            $table->string('postal_code')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('salary_month')->nullable();
            $table->string('total')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('player_status')->default(0);
            $table->string('code')->nullable();


            $table->bigInteger('coachs_id')->unsigned()->nullable();
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
