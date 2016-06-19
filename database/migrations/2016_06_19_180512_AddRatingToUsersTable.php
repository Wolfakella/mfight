<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rating')->after('about')->default('1600');
        });
        Schema::table('duels', function (Blueprint $table) {
        	$table->integer('rating1')->after('result1')->nullable();
        	$table->integer('rating2')->after('result2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
        Schema::table('duels', function (Blueprint $table) {
       		$table->dropColumn(['rating1', 'rating2']);
        });
    }
}
