<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search', function(Blueprint $table)
		{
            $table->engine = 'MyISAM';
            
			$table->integer('id');
			$table->text('title_description');
			$table->integer('category_id')->unsigned();
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('active')->default(1);
            $table->timestamps();
            
            $table->index('category_id');
            $table->index('latitude');
            $table->index('longitude');
		});
        
        DB::statement('ALTER TABLE search ADD FULLTEXT search(title_description)');
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('search');
	}

}
