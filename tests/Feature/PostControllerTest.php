<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    public function testGetAllDatabasePostsExpectsIsOk()
    {
        $response = $this->get('/api/v1/posts');

        $response->assertOk();

        $response->assertJsonStructure([
            [
                "id",
                "title",
                "subtitle",
                "content",
                "created_id",
                "modified_id",
                "created_at",
                "updated_at",
            ]
        ]);
    }

    public function testGetAnPostDatabaseByIdExpectsIsOk()
    {
        $response = $this->get('/api/v1/posts/' . random_int(1, 2));

        $response->assertOk();

        $response->assertJsonStructure([
            "id",
            "title",
            "subtitle",
            "content",
            "created_id",
            "modified_id",
            "created_at",
            "updated_at",
        ]);
    }
}