<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galleries = [
    		['id' => 1, 'title' => 'Imagen 1', 'slug' => 'imagen-1', 'category_id' => 1],
    		['id' => 2, 'title' => 'Imagen 2', 'slug' => 'imagen-2', 'category_id' => 1],
    		['id' => 3, 'title' => 'Imagen 3', 'slug' => 'imagen-3', 'category_id' => 1],
    		['id' => 4, 'title' => 'Imagen 4', 'slug' => 'imagen-4', 'category_id' => 1],
    		['id' => 5, 'title' => 'Imagen 5', 'slug' => 'imagen-5', 'category_id' => 1],
    		['id' => 6, 'title' => 'Imagen 6', 'slug' => 'imagen-6', 'category_id' => 1],
    		['id' => 7, 'title' => 'Imagen 7', 'slug' => 'imagen-7', 'category_id' => 1],
    		['id' => 8, 'title' => 'Imagen 8', 'slug' => 'imagen-8', 'category_id' => 1],
    	];
    	DB::table('galleries')->insert($galleries);
    }
}
