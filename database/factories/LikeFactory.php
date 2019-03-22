<?php

use Faker\Generator as Faker;
use App\Like;
use App\User;
use App\Post;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'like' => (bool) random_int(0, 1),
        'created_id' => User::inRandomOrder()->first()->id,
        'post_id' => Post::inRandomOrder()->first()->id,
        'comment_id' => null,
    ];
});
