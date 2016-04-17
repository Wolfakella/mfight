<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('types', function(Blueprint $table){
    		$table->increments('id');
    		$table->string('text');
    	});
    	
        Schema::create('duels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champ_id')->unsigned();
            $table->integer('situation_id')->unsigned();
            $table->integer('player1_id')->unsigned();
            $table->integer('player2_id')->unsigned();
            $table->integer('result1')->unsigned()->nullable()->default(null);
            $table->integer('result2')->unsigned()->nullable()->default(null);
            $table->integer('type_id')->unsigned();
            $table->timestamp('time');
            $table->timestamps();
            
            $table->foreign('champ_id')->references('id')->on('champs');
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->foreign('player1_id')->references('id')->on('users');
            $table->foreign('player2_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('duels');
        Schema::drop('types');
    }
}
