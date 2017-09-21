<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuisineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuisine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->string('Type');
            $table->string('Likes')->nullable();;
            $table->string('DisLikes')->nullable();;

        //relationships
            //Manager
            $table->integer('restaurantId')->unsigned();

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
        Schema::dropIfExists('cuisine');
    }
}
