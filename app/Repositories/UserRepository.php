<?php

namespace App\Repositories;

use App\Model\User;

class UserRepository implements UserRepositoryInterface
{

    private User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function find(User $user): ?User
    {
        return $this->model->find($user->id);
    }

    public function findAll(): ?array
    {
        return $this->model->all();
    }
}