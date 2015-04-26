<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		
			Category::create(array(
		        'title'	=> 'Vehículos',
				'description' => 'Vehículos',
			));
			Category::create(array(
		        'title'	=> 'Inmuebles',
				'description' => 'Inmuebles',
			));
			Category::create(array(
		        'title'	=> 'Electrónicos y celulares',
				'description' => 'Electrónicos y celulares',
			));
			Category::create(array(
		        'title'	=> 'Videojuegos, libros, películas',
				'description' => 'Videojuegos, libros, películas',
			));
			Category::create(array(
		        'title'	=> 'Casa y jardín',
				'description' => 'Casa y jardín',
			));
			Category::create(array(
		        'title'	=> 'Desportes y ocio',
				'description' => 'Desportes y ocio',
			));
			Category::create(array(
		        'title'	=> 'Ropa y accesorios',
				'description' => 'Ropa y accesorios',
			));
			Category::create(array(
		        'title'	=> 'Arte y coleccionables',
				'description' => 'Arte y coleccionables',
			));
			Category::create(array(
		        'title'	=> 'Bebes y niños',
				'description' => 'Bebes y niños',
			));
			Category::create(array(
		        'title'	=> 'Otros',
				'description' => 'Otros',
			));
	}
}