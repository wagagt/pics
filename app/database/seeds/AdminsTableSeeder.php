<?php

class AdminsTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

			Admin::create(array(
				'name'	=>	'waga',
				'email'	=>	'wilver@xyznetworkinc.com',
				'password'	=>	Hash::make('waga'),
				'rol'		=> 'superadmin',
				'status'	=>	true,
			));

			Admin::create(array(
				'name'	=>	'attakinsky',
				'email'	=>	'jblanco@xyznetworkinc.com',
				'password'	=>	Hash::make('attak'),
				'rol'		=> 'admin',
				'status'	=>	true,
			));

			Admin::create(array(
				'name'	=>	'eli',
				'email'	=>	'eliezer@xyznetworkinc.com',
				'password'	=>	Hash::make('eli'),
				'rol'		=> 'admin',
				'status'	=>	true,
			));
	}

}