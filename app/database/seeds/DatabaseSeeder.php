<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->command->info('Users table seeding!');
		$this->call('UsersTableSeeder');
        
        $this->command->info('Currency table seeding!');
		$this->call('CurrencyTableSeeder');
        
		$this->command->info('Admins table seeding!');
		$this->call('AdminsTableSeeder');
        
        $this->command->info('Categories table seeding!');
        $this->call('CategoriesTableSeeder');
        
        $this->command->info('Products table seeding!');
        $this->call('ProductsTableSeeder');

        $this->command->info('Reasons table seeding!');
        $this->call('ReasonsTableSeeder');
	}

}
