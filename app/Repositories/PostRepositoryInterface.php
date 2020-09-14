<?php

namespace App\Repositories;

use App\Model\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function find(Post $post): ?Post;

    public function findAll(): ?Collection;
}