<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
    		['id' => 1, 'name' => 'Futbol', 'slug' => 'futbol'],
    		['id' => 2, 'name' => 'Futbol Femenino', 'slug' => 'futbol-femenino'],
            ['id' => 3, 'name' => 'Baby Futbol', 'slug' => 'baby-futbol']
    	];
    	DB::table('categories')->insert($categories);
    }
}
