<?php

use Faker\Generator as Faker;
use App\Favorite;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,10),
        'publication_id' => rand(1,40)
    ];
});
