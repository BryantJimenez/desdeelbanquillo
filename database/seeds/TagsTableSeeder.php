<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
    		['id' => 1, 'name' => 'Futbol', 'slug' => 'futbol'],
    		['id' => 2, 'name' => 'Futbol Femenino', 'slug' => 'futbol-femenino']
    	];
    	DB::table('tags')->insert($tags);
    }
}
