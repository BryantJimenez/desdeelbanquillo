<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = [
    		['id' => 1, 'title' => 'Video 1', 'slug' => 'video-1', 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
    		['id' => 2, 'title' => 'Video 2', 'slug' => 'video-2', 'video' => 'https://www.youtube.com/watch?v=FCcrB1ZXYQM', 'created_at' => Carbon\Carbon::create(2020, 07, 04)]
    	];
    	DB::table('videos')->insert($videos);
    }
}
