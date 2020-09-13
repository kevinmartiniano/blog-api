<?php

namespace App\Repositories;

use App\Model\User;

interface UserRepositoryInterface
{
    public function find(User $user): ?User;

    public function findAll(): ?array;
}