<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Post;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => Str::random(100),
        'content' => Str::random(100),
        'created_id' => User::inRandomOrder()->first()->id,
        'modified_id' => '',
    ];
});
