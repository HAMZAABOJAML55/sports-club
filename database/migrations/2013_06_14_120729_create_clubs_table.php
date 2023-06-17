<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_name');
            $table->string('email' ,128)->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('image_path')->nullable();
//            $table->string('subscription_type')->nullable();
            $table->string('subscription_period')->nullable();
            $table->bigInteger('subscribes_id')->unsigned();
            $table->foreign('subscribes_id')->references('id')->on('subscribes');
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
        Schema::dropIfExists('clubs');
    }
}
