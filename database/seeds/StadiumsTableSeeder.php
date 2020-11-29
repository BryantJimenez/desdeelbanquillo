<?php

use Illuminate\Database\Seeder;

class StadiumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stadiums = [
    		['id' => 1, 'name' => 'Estadio Bicentenario', 'slug' => 'estadio-bicentenario'],
    		['id' => 2, 'name' => 'Estadio de Prueba', 'slug' => 'estadio-de-prueba'],
    		['id' => 3, 'name' => 'Nuevo Estadio', 'slug' => 'nuevo-estadio'],
    		['id' => 4, 'name' => 'Estadio de los Campeones', 'slug' => 'estadio-de-los-campeones']
    	];
    	DB::table('stadiums')->insert($stadiums);
    }
}
