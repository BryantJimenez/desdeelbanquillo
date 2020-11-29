<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
    		['id' => 1, 'name' => 'Portero', 'slug' => 'portero', 'prefix' => 'POR'],
            ['id' => 2, 'name' => 'Defensa Central', 'slug' => 'defensa-central', 'prefix' => 'DFC'],
            ['id' => 3, 'name' => 'Lateral Derecho', 'slug' => 'lateral-derecho', 'prefix' => 'LD'],
            ['id' => 4, 'name' => 'Lateral Izquierdo', 'slug' => 'lateral-izquierdo', 'prefix' => 'LI'],
    		['id' => 5, 'name' => 'Mediocentro Defensivo', 'slug' => 'mediocentro-defensivo', 'prefix' => 'MCD'],
            ['id' => 6, 'name' => 'Mediocentro Ofensivo', 'slug' => 'mediocentro-ofensivo', 'prefix' => 'MCO'],
            ['id' => 7, 'name' => 'Extremo Derecho', 'slug' => 'extremo-derecho', 'prefix' => 'ED'],
            ['id' => 8, 'name' => 'Extremo Izquierdo', 'slug' => 'extremo-izquierdo', 'prefix' => 'EI'],
            ['id' => 9, 'name' => 'Mediapunta', 'slug' => 'mediapunta', 'prefix' => 'MP'],
            ['id' => 10, 'name' => 'Delantero Centro', 'slug' => 'delantero-centro', 'prefix' => 'DC']
    	];
    	DB::table('positions')->insert($positions);
    }
}
