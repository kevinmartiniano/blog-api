<?php

namespace App\Repositories;

use App\Model\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function find(User $user): ?User
    {
        return $this->model->find($user->id);
    }

    public function findAll(): ?Collection
    {
        return $this->model->all();
    }
}