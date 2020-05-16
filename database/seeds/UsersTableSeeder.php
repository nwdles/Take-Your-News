<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        factory(User::class, 10)->create();
    }
}
