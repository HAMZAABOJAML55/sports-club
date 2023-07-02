<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();#full_name
//            $table->integer('emp_id')->unique()->nullable();#ID
            $table->string('email' ,128)->unique();#Email
            $table->string('password');#password
            $table->date('date_of_birth')->nullable();
            $table->string('description')->nullable();
            $table->string('full_description')->nullable();
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('national_id',20)->unique()->nullable();

            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->string('image_path')->nullable();
            $table->string('start_time_shift')->nullable();#####################
            $table->string('end_time_shift')->nullable();##################
            $table->boolean('emp_status')->default(0)->nullable();
            $table->string('code')->nullable();
            $table->string('total_salary')->nullable();

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
        Schema::dropIfExists('employes');
    }
}
