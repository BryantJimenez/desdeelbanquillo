<?php

use Illuminate\Database\Seeder;

class NewstagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$news_tag = [
    		['id' => 1, 'news_id' => '1', 'tag_id' => '1'],
    		['id' => 2, 'news_id' => '2', 'tag_id' => '1'],
    		['id' => 3, 'news_id' => '3', 'tag_id' => '1'],
    		['id' => 4, 'news_id' => '4', 'tag_id' => '2'],
    		['id' => 5, 'news_id' => '5', 'tag_id' => '1'],
    		['id' => 6, 'news_id' => '6', 'tag_id' => '1'],
    		['id' => 7, 'news_id' => '7', 'tag_id' => '1'],
    		['id' => 8, 'news_id' => '7', 'tag_id' => '2'],
    		['id' => 9, 'news_id' => '8', 'tag_id' => '1'],
    		['id' => 10, 'news_id' => '9', 'tag_id' => '1'],
    		['id' => 11, 'news_id' => '10', 'tag_id' => '2'],
    		['id' => 12, 'news_id' => '11', 'tag_id' => '1'],
    	];
    	DB::table('news_tag')->insert($news_tag);
    }
}
