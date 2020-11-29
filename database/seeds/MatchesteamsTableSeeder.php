<?php

use Illuminate\Database\Seeder;

class MatchesteamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $match_team = [
    		['id' => 1, 'goals' => null, 'match_id' => '1', 'team_id' => '1'],
            ['id' => 2, 'goals' => null, 'match_id' => '1', 'team_id' => '2'],
            ['id' => 3, 'goals' => null, 'match_id' => '2', 'team_id' => '3'],
            ['id' => 4, 'goals' => null, 'match_id' => '2', 'team_id' => '4'],
    		['id' => 5, 'goals' => null, 'match_id' => '3', 'team_id' => '2'],
            ['id' => 6, 'goals' => null, 'match_id' => '3', 'team_id' => '3'],
            ['id' => 7, 'goals' => null, 'match_id' => '4', 'team_id' => '4'],
            ['id' => 8, 'goals' => null, 'match_id' => '4', 'team_id' => '1'],
            ['id' => 9, 'goals' => null, 'match_id' => '5', 'team_id' => '5'],
            ['id' => 10, 'goals' => null, 'match_id' => '5', 'team_id' => '6'],
            ['id' => 11, 'goals' => null, 'match_id' => '6', 'team_id' => '7'],
    		['id' => 12, 'goals' => null, 'match_id' => '6', 'team_id' => '8'],
            ['id' => 13, 'goals' => null, 'match_id' => '7', 'team_id' => '6'],
            ['id' => 14, 'goals' => null, 'match_id' => '7', 'team_id' => '7'],
    	];
    	DB::table('match_team')->insert($match_team);
    }
}
