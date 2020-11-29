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
    		['id' => 1, 'image' => 'bannerprincipal.png', 'title' => '1er carousel ejemplo', 'slug' => '1er-carousel-ejemplo', 'featured' => 1, 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'type' => 1, 'state' => '1'],
    		['id' => 2, 'image' => 'imagen.jpg', 'title' => '2do carousel ejemplo', 'slug' => '2do-carousel-ejemplo', 'featured' => 1, 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'type' => 1, 'state' => '1'],
    		['id' => 3, 'image' => 'bannerprincipallargo.png', 'title' => '1er banner principal 2 ejemplo', 'slug' => '1er-banner-principal-2-ejemplo', 'featured' => 2, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 1, 'state' => '1'],
    		['id' => 4, 'image' => 'bannermacdonalds.png', 'title' => '1er banner principal 3 ejemplo', 'slug' => '1er-banner-principal-3-ejemplo', 'featured' => 3, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 1, 'state' => '1'],
    		['id' => 5, 'image' => 'bannerreebook.png', 'title' => '1er banner principal 4 ejemplo', 'slug' => '1er-banner-principal-4-ejemplo', 'featured' => 4, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 1, 'state' => '1'],
            ['id' => 6, 'image' => 'imagencocacola.png', 'title' => '1er banner noticias 1 ejemplo', 'slug' => '1er-banner-noticias-1-ejemplo', 'featured' => 5, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 2, 'state' => '1'],
            ['id' => 7, 'image' => 'imagenmacdonaldslarga.png', 'title' => '2do banner noticias 2 ejemplo', 'slug' => '2do-banner-noticias-2-ejemplo', 'featured' => 6, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 2, 'state' => '1'],
            ['id' => 8, 'image' => 'imagenvisa.png', 'title' => '3er banner noticias 3 ejemplo', 'slug' => '3er-banner-noticias-3-ejemplo', 'featured' => 7, 'pre_url' => 'https://', 'url' => 'www.google.com', 'target' => 1, 'type' => 2, 'state' => '1'],
    	];
    	DB::table('banners')->insert($banner);
    }
}
