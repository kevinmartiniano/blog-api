<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    public function testGetAllDatabaseUsersExpectsIsOk()
    {
        $response = $this->get('/api/v1/users');

        $response->assertOk();

        $response->assertJsonStructure([
            [
                "id",
                "name",
                "email",
                "email_verified_at",
                "created_at",
                "updated_at",
                "user_type_id",
            ]
        ]);
    }

    public function testGetAnUserDatabaseByIdExpectsIsOk()
    {
        $response = $this->get('/api/v1/users/' . random_int(1, 2));

        $response->assertOk();

        $response->assertJsonStructure([
            "id",
            "name",
            "email",
            "email_verified_at",
            "created_at",
            "updated_at",
            "user_type_id",
        ]);
    }
}