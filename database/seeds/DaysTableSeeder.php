<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
    		['id' => 1, 'day' => '1', 'slug' => 'jornada', 'state' => '1', 'tournament_id' => '1'],
            ['id' => 2, 'day' => '2', 'slug' => 'jornada-0', 'state' => '0', 'tournament_id' => '1'],
            ['id' => 3, 'day' => '3', 'slug' => 'jornada-1', 'state' => '0', 'tournament_id' => '1'],
            ['id' => 4, 'day' => '4', 'slug' => 'jornada-2', 'state' => '0', 'tournament_id' => '1'],
    		['id' => 5, 'day' => '1', 'slug' => 'jornada-3', 'state' => '1', 'tournament_id' => '2'],
            ['id' => 6, 'day' => '2', 'slug' => 'jornada-4', 'state' => '0', 'tournament_id' => '2'],
            ['id' => 7, 'day' => '3', 'slug' => 'jornada-5', 'state' => '0', 'tournament_id' => '2'],
            ['id' => 8, 'day' => '4', 'slug' => 'jornada-6', 'state' => '0', 'tournament_id' => '2'],
            ['id' => 9, 'day' => '1', 'slug' => 'jornada-7', 'state' => '1', 'tournament_id' => '3'],
            ['id' => 10, 'day' => '2', 'slug' => 'jornada-8', 'state' => '0', 'tournament_id' => '3'],
            ['id' => 11, 'day' => '1', 'slug' => 'jornada-9', 'state' => '1', 'tournament_id' => '4'],
            ['id' => 12, 'day' => '2', 'slug' => 'jornada-10', 'state' => '0', 'tournament_id' => '4'],
            ['id' => 13, 'day' => '1', 'slug' => 'jornada-11', 'state' => '1', 'tournament_id' => '5'],
            ['id' => 14, 'day' => '2', 'slug' => 'jornada-12', 'state' => '0', 'tournament_id' => '5'],
            ['id' => 15, 'day' => '1', 'slug' => 'jornada-13', 'state' => '1', 'tournament_id' => '6'],
            ['id' => 16, 'day' => '2', 'slug' => 'jornada-14', 'state' => '0', 'tournament_id' => '6'],
    	];
    	DB::table('days')->insert($days);
    }
}
