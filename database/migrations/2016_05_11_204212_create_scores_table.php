<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storedScore');
            $table->integer('totalScore');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->integer('counter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //Drop table
      Schema::drop('scores');
    }
}
