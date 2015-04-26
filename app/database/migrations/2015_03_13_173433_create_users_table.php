<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table)
		{
            $table->increments('id');
            $table->string('fbid',32);
            $table->string('name', 128);
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('email', 64);
            $table->string('gender', 8)->nullable();
            $table->text('picture');
            $table->boolean('active')->default(1);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->unique('fbid');
		});
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
