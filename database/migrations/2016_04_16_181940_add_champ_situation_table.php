<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChampSituationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champ_situation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champ_id')->unsigned();
            $table->integer('situation_id')->unsigned();
            $table->foreign('champ_id')->references('id')->on('champs');
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('champ_situation');
    }
}
