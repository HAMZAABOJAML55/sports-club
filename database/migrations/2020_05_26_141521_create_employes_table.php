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
            $table->string('name');
            $table->text('email');
            $table->date('date_of_birth');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('salary');
            $table->integer('nationality_id');
            $table->string('emp_descriptio');
            $table->string('full_descriptio');
            $table->integer('employee_num');
            $table->foreignId('section_id')->references('id')->on('sections');
//            $table->foreignId('employment_type_id')->references('id')->on('employment');
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
