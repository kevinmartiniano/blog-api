<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Comment;
use App\User;
use App\Post;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(100),
        'created_id' => User::inRandomOrder()->first()->id,
        'parent_id' => Post::inRandomOrder()->first()->id,
    ];
});
