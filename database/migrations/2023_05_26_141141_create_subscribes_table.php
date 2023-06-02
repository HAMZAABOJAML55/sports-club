<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscripesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_name');
            $table->text('phone');
            $table->string('email');
            $table->string('subscription_number');
            $table->date('date_of_birth');
            $table->date('start_time');
            $table->date('end_time');
            $table->text('coach_description');
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtupe')->nullable();
            $table->foreignId('player_id')->references('id')->on('players');
            $table->string('employment_type');
            // $table->foreignId('salary_id')->references('id')->on('salary');
            $table->foreignId('nationality_id')->references('id')->on('nationalitys');
            $table->foreignId('location_id')->references('id')->on('locations');
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
        Schema::dropIfExists('subscripes');
    }
}
