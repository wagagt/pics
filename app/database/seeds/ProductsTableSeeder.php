<?php
// Composer: "fzaninotto/faker": "v1.3.0"

class ProductsTableSeeder extends Seeder {
    
    public function run()
	{
        $limit = 200;
        
        $this->command->info("Seeding {$limit} products with images. It's a good time to go for a coffee (seriously).");
        
        $faker = Faker\Factory::create('es_ES');
        
        $countries_iso = DB::table('currency')->lists('iso_country');
        
        for($product_id = 1; $product_id <= $limit; $product_id++) {
            
            $user_id = rand(1,3);
            $category_id = rand(1,10);
            $currency_id = rand(1,25);
            
            $iso_limit = count($countries_iso)-1;
            $iso_random = rand(0,$iso_limit);
            
            $fake_title = $faker->sentence(rand(5,10));
            $fake_description = $faker->paragraph(rand(2,5));
            
            $latitude = "14.".$faker->numberBetween($min = 5100000, $max = 7000000);
            $longitude = "-90.".$faker->numberBetween($min = 4400000, $max = 6100000);
            
            Product::create(array(
		        'user_id'	=> $user_id,
				'category_id' => $category_id,
				'currency_id' => $currency_id,
				'title' => $fake_title,
				'description' => $fake_description,
				'price' => $faker->randomFloat(2,5,700),
				'latitude' => $latitude,
				'longitude' => $longitude,
                'iso_country' => $countries_iso[$iso_random],
                'country' => DB::table('currency')->where('iso_country','=',$countries_iso[$iso_random])->pluck('country'),
				'ip' => rand(1,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255),
			));
            
            Search::create(array(
                'id' => $product_id,
                'title_description' => $fake_title . ' ' . $fake_description,
                'category_id' => $category_id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                
            ));
            
            $images = rand(1,4);
            $folder_path = base_path() . '/';
            $image_path =  '/products/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $category_id . '/' . $user_id . '/';
            
            ApiTools::create_path($image_path);
            
            for($b = 1; $b <= $images; $b++) {
                
                $time = str_replace(array('.',' '),'',microtime());

                // imagen grande
                $fake_image = file_get_contents($faker->imageUrl('640', '480'));
                $fileName = $time . '.jpg';
                $file_to_save = base_path().$image_path.$fileName;
                file_put_contents($file_to_save, $fake_image);
                            
                // thumbnail
                $fake_thumb = file_get_contents($faker->imageUrl('150', '100'));
                $thumbName = $time . '-thumb.jpg';
                $thumb_to_save = base_path().$image_path.$thumbName;
                file_put_contents($thumb_to_save, $fake_thumb);
                
                Image::create(array(
                    'product_id' => $product_id,
                    'filename' => $image_path.$fileName,
                    'thumbnail' => $image_path.$thumbName,
                ));

                            
            }
        }
    }
}
