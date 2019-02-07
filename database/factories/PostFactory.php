<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->text(1000),
        'published_at' => $faker->dateTimeBetween('-2 months', '+2 months'),
    ];
});
