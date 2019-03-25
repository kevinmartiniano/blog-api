<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Post;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'subtitle' => $faker->realText(50),
        'content' => $faker->realText(250),
        'created_id' => $user = User::inRandomOrder()->first()->id,
        'modified_id' => $user,
    ];
});
