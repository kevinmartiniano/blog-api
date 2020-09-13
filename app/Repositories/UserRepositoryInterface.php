<?php

namespace App\Repositories;

use App\Model\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function find(User $user): ?User;

    public function findAll(): ?Collection;
}