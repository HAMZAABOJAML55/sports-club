<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_name');
            $table->text('phone');
            $table->string('email' ,128)->unique();
            $table->string('password');
            $table->string('salary');
            $table->string('image_path')->nullable();
            $table->string('subscription_number');
            $table->date('date_of_birth');
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->text('coach_description')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtupe')->nullable();
            $table->bigInteger('profs_id')->unsigned();
            $table->foreign('profs_id')->references('id')->on('profs');
            $table->bigInteger('employment_type_id')->unsigned();
            $table->foreign('employment_type_id')->references('id')->on('employmenttypes');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->bigInteger('sub_location_id')->unsigned();
            $table->foreign('sub_location_id')->references('id')->on('sub_locations');
            $table->bigInteger('genders_id')->unsigned();
            $table->foreign('genders_id')->references('id')->on('genders')->onDelete('cascade');
            $table->bigInteger('nationality_id')->unsigned();
            $table->foreign('nationality_id')->references('id')->on('nationalitys')->onDelete('cascade');
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
        Schema::dropIfExists('coachs');
    }
}
