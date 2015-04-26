<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchCacheTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search_cache', function($table)
        {
            $table->string('key');
            $table->integer('page');
            $table->text('value');
            $table->integer('expiration');
            
            $table->unique(array('key', 'page'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('search_cache');
	}

}
