<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        	$table->renameColumn('email', 'login');
        });
        Schema::table('users', function (Blueprint $table) {
        	$table->string('middlename')->after('name')->nullable();
        	$table->string('surname')->after('middlename')->nullable();
        	$table->string('phone', 20)->after('surname')->nullable();
        	$table->string('email')->after('phone')->nullable();
        	$table->string('position')->after('email')->nullable();
        	$table->string('company')->after('position')->nullable();
        	$table->text('about')->after('company')->nullable();
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
            $table->dropColumn(['middlename','surname','phone','email','position','company','about']);
     	});
        	Schema::table('users', function (Blueprint $table) {
        		$table->renameColumn('login', 'email');
        	});
    }
}
