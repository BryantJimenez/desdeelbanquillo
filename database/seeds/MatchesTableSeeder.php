<?php

use Illuminate\Database\Seeder;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matches = [
    		['id' => 1, 'date' => '2020/08/01 14:00:00', 'slug' => 'partido', 'state' => '0', 'stadium_id' => '1', 'day_id' => '1'],
            ['id' => 2, 'date' => '2020/08/02 14:00:00', 'slug' => 'partido-0', 'state' => '0', 'stadium_id' => '2', 'day_id' => '1'],
            ['id' => 3, 'date' => '2020/08/04 12:00:00', 'slug' => 'partido-1', 'state' => '0', 'stadium_id' => '3', 'day_id' => '2'],
            ['id' => 4, 'date' => '2020/08/05 14:00:00', 'slug' => 'partido-2', 'state' => '0', 'stadium_id' => '1', 'day_id' => '2'],
    		['id' => 5, 'date' => '2020/08/06 12:00:00', 'slug' => 'partido-3', 'state' => '0', 'stadium_id' => '4', 'day_id' => '3'],
            ['id' => 6, 'date' => '2020/08/07 14:00:00', 'slug' => 'partido-4', 'state' => '0', 'stadium_id' => '2', 'day_id' => '3'],
            ['id' => 7, 'date' => '2020/08/04 16:00:00', 'slug' => 'partido-5', 'state' => '0', 'stadium_id' => '3', 'day_id' => '4']
    	];
    	DB::table('matches')->insert($matches);
    }
}
