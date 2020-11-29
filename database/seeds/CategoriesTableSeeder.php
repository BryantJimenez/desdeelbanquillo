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
    		['id' => 1, 'name' => 'Entrevistas', 'slug' => 'entrevistas'],
            ['id' => 2, 'name' => 'E-Sport', 'slug' => 'e-sport'],
            ['id' => 3, 'name' => 'Premios Deb', 'slug' => 'premios-deb'],
            ['id' => 4, 'name' => 'Futbol', 'slug' => 'futbol'],
    		['id' => 5, 'name' => 'Futbol Femenino', 'slug' => 'futbol-femenino'],
            ['id' => 6, 'name' => 'Baby Futbol', 'slug' => 'baby-futbol']
    	];
    	DB::table('categories')->insert($categories);
    }
}
