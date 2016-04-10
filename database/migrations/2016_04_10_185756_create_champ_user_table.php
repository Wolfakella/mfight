<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champ_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champ_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('champ_id')->references('id')->on('champs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status')->nullable();
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
        Schema::drop('champ_user');
    }
}
