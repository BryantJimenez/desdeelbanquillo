<?php

use Illuminate\Database\Seeder;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = [
    		['id' => 1, 'title' => 'Infantil Primera. Grupo A', 'slug' => 'infantil-primera-grupo-a', 'year' => '2020', 'day' => '4', 'position' => '6'],
    		['id' => 2, 'title' => 'Benjamin Primera. Grupo B', 'slug' => 'benjamin-primera-grupo-b', 'year' => '2020', 'day' => '4', 'position' => '5'],
    		['id' => 3, 'title' => 'Copa Primera Infantil. Grupo B', 'slug' => 'copa-primera-infantil-grupo-b', 'year' => '2020', 'day' => '2', 'position' => '4'],
    		['id' => 4, 'title' => 'Futbol - Liga Regional de Lanzarote 2019/2020', 'slug' => 'futbol-liga-regional-de-lanzarote-2019-2020', 'year' => '2020', 'day' => '2', 'position' => '3'],
    		['id' => 5, 'title' => 'Alevin Primera. Grupo B', 'slug' => 'alevin-primera-grupo-b', 'year' => '2020', 'day' => '2', 'position' => '2'],
    		['id' => 6, 'title' => 'Copa Senior Fundación La Caja de Canarias', 'slug' => 'copa-senior-fundacion-la-caja-de-canarias', 'year' => '2020', 'day' => '2', 'position' => '1']
    	];
    	DB::table('tournaments')->insert($tournaments);
    }
}
