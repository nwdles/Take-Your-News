<?php

use Illuminate\Database\Seeder;
use App\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            factory(Favorite::class, 400)->create();
        } catch (Exception $e) {

        }
    }
}
