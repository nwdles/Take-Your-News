<?php

use Faker\Generator as Faker;
use App\Publication;

$factory->define(Publication::class, function (Faker $faker) {
    return [
        'header' => $faker->text(16),
        'description' => $faker->text(100),
        'text' => $faker->text(2500),
        'category_id' => rand(1,7)
    ];
});
