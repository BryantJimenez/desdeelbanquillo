<?php

use Illuminate\Database\Seeder;

class CategorynewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_news = [
    		['id' => 1, 'news_id' => 1, 'category_id' => 1],
            ['id' => 2, 'news_id' => 2, 'category_id' => 3],
            ['id' => 3, 'news_id' => 3, 'category_id' => 2],
            ['id' => 4, 'news_id' => 4, 'category_id' => 5],
    		['id' => 5, 'news_id' => 5, 'category_id' => 5],
            ['id' => 6, 'news_id' => 6, 'category_id' => 3],
            ['id' => 7, 'news_id' => 7, 'category_id' => 4],
            ['id' => 8, 'news_id' => 8, 'category_id' => 4],
            ['id' => 9, 'news_id' => 9, 'category_id' => 3],
            ['id' => 10, 'news_id' => 10, 'category_id' => 3],
            ['id' => 11, 'news_id' => 11, 'category_id' => 3]
    	];
    	DB::table('category_news')->insert($category_news);
    }
}
