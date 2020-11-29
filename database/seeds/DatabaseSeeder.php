<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CategorynewsTableSeeder::class);
        $this->call(NewstagsTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(CategorygalleryTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(StadiumsTableSeeder::class);
        $this->call(TournamentsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(DaysTableSeeder::class);
        $this->call(MatchesTableSeeder::class);
        $this->call(MatchesteamsTableSeeder::class);
        $this->call(VisitsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
