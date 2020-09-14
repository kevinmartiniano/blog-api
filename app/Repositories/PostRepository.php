<?php

namespace App\Repositories;

use App\Model\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{

    private $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function find(Post $post): ?Post
    {
        return $this->model->find($post->id);
    }

    public function findAll(): ?Collection
    {
        return $this->model->all()->orderBy('created_at', 'desc')->paginate();
    }
}