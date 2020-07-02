<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
    		['id' => 1, 'image' => 'bannerprincipal.png', 'title' => '1er carousel ejemplo', 'slug' => '1er-carousel-ejemplo', 'type' => 1, 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'state' => '1'],
    		['id' => 2, 'image' => 'imagen.jpg', 'title' => '2do carousel ejemplo', 'slug' => '2do-carousel-ejemplo', 'type' => 1, 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'state' => '1'],
    		['id' => 3, 'image' => 'bannerprincipallargo.png', 'title' => '1er banner principal 2 ejemplo', 'slug' => '1er-banner-principal-2-ejemplo', 'type' => 2, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'state' => '1'],
    		['id' => 4, 'image' => 'bannermacdonalds.png', 'title' => '1er banner principal 3 ejemplo', 'slug' => '1er-banner-principal-3-ejemplo', 'type' => 3, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'state' => '1'],
    		['id' => 5, 'image' => 'bannerreebook.png', 'title' => '1er banner principal 4 ejemplo', 'slug' => '1er-banner-principal-4-ejemplo', 'type' => 4, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'state' => '1'],
    	];
    	DB::table('banners')->insert($banner);
    }
}
