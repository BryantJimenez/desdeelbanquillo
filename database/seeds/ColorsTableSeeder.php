<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
    		['id' => 1, 'color' => '#dddddd', 'position' => 1, 'tournament_id' => '1'],
            ['id' => 2, 'color' => '#dddddd', 'position' => 2, 'tournament_id' => '1'],
            ['id' => 3, 'color' => '#dddddd', 'position' => 3, 'tournament_id' => '1'],
            ['id' => 4, 'color' => '#dddddd', 'position' => 4, 'tournament_id' => '1'],
    		['id' => 5, 'color' => '#dddddd', 'position' => 5, 'tournament_id' => '1'],
            ['id' => 6, 'color' => '#dddddd', 'position' => 6, 'tournament_id' => '1'],
            ['id' => 7, 'color' => '#dddddd', 'position' => 7, 'tournament_id' => '1'],
            ['id' => 8, 'color' => '#dddddd', 'position' => 8, 'tournament_id' => '1'],
            ['id' => 9, 'color' => '#dddddd', 'position' => 9, 'tournament_id' => '1'],
            ['id' => 10, 'color' => '#dddddd', 'position' => 10, 'tournament_id' => '1'],
            ['id' => 11, 'color' => '#dddddd', 'position' => 11, 'tournament_id' => '1'],
            ['id' => 12, 'color' => '#dddddd', 'position' => 12, 'tournament_id' => '1'],
            ['id' => 13, 'color' => '#dddddd', 'position' => 13, 'tournament_id' => '1'],
            ['id' => 14, 'color' => '#dddddd', 'position' => 14, 'tournament_id' => '1'],
            ['id' => 15, 'color' => '#dddddd', 'position' => 15, 'tournament_id' => '1'],
            ['id' => 16, 'color' => '#dddddd', 'position' => 16, 'tournament_id' => '1'],
            ['id' => 17, 'color' => '#dddddd', 'position' => 17, 'tournament_id' => '1'],
            ['id' => 18, 'color' => '#dddddd', 'position' => 18, 'tournament_id' => '1'],
            ['id' => 19, 'color' => '#dddddd', 'position' => 19, 'tournament_id' => '1'],
            ['id' => 20, 'color' => '#dddddd', 'position' => 20, 'tournament_id' => '1']
    	];
    	DB::table('colors')->insert($colors);
    }
}
