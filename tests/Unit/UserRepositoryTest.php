<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{

    public function testFindAllUsers()
    {

        $userRepository = UserRepository::findAll();

        dump($userRepository);
    }

}
