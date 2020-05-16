<?php

use Illuminate\Database\Seeder;
use App\Publication;

class PublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Publication::class, 40)->create();
    }
}
