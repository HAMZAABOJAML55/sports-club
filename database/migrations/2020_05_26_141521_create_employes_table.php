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
            $table->string('name')->nullable();
            $table->string('email' ,128)->unique();
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->string('salary')->nullable();
            $table->bigInteger('nationalitys_id')->unsigned();
            $table->foreign('nationalitys_id')->references('id')->on('nationalitys');
            $table->string('emp_descriptio')->nullable();
            $table->string('full_descriptio')->nullable();
            $table->integer('employee_num')->nullable();
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
