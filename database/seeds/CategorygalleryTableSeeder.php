<?php

use Illuminate\Database\Seeder;

class CategorygalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
    		['id' => 1, 'name' => 'Futbol', 'slug' => 'futbol']
    	];
    	DB::table('category_gallery')->insert($categories);
    }
}
