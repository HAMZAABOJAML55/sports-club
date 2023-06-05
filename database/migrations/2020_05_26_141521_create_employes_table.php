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
            $table->string('description')->nullable();
            $table->string('full_description')->nullable();
            $table->integer('number')->nullable();
             $table->integer('emp_id')->nullable();
        
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
