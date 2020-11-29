<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
    		['id' => 1, 'facebook' => null, 'instagram' => null, 'twitter' => null, 'email_one' => null, 'email_two' => null, 'pre_url' => null, 'listen' => null, 'brands' => 'imagenmarcas.png']
    	];
    	DB::table('settings')->insert($settings);
    }
}
